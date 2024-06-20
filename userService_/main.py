from fastapi import FastAPI,HTTPException,Depends,status
from pydantic import BaseModel
from  typing import Annotated
import models 
from database import engine,SessionLocal
from sqlalchemy.orm import Session
from jose import jwt,JWTError
from passlib.context import CryptContext
from fastapi.security import OAuth2PasswordBearer,OAuth2PasswordRequestForm
from datetime import timedelta,datetime



app=FastAPI()
#create all database tables 
models.Base.metadata.create_all(bind=engine)
oauth2_scheme=OAuth2PasswordBearer(tokenUrl="token")

#JWT authentication settings 
SECRET_KEY="secret_key"
ALGORITHM="HS256"
ACCESS_TOKEN_EXPIRE_MINUTES=30

#password hashing
pwd_context=CryptContext(schemes=["bcrypt"],deprecated="auto")

#Dependency to get database session 
def get_db():
    db=SessionLocal()
    try:
        yield db
    finally:
        db.close()

#schema 
class TaiKhoanBase(BaseModel):
   username:str
#    password:str
   email:str
   vaitro:str
   tinhtrang:str
#    class Config:
#         orm_mode = True

class TaiKhoan_CreateBase(TaiKhoanBase):
    password:str

class TaiKhoan(TaiKhoanBase):
    id:int 
    class Config:
        orm_mode = True
class Token(BaseModel):
    access_token:str
    token_type:str

class UserOut(BaseModel):
    id: int
    username:str

    email:str
    vaitro:str
    tinhtrang:str
    class Config:
        orm_mode = True

class NguoiDungBase(BaseModel):
    hoten:str
    sdt:str
    diachi:str
    gioitinh:str
    ngaysinh:str
    diachi:str
    id_taikhoan:int
    class Config:
        orm_mode = True

class PasswordChangeRequest(BaseModel):
    old_password: str
    new_password: str
#Function : Create access_token 


class DoiTac(BaseModel):
    id_taikhoan: int
    tendoitac:str
    sdt:str
    diachi:str
    email:str
    nguoidaidien:str
    masothue:str
    logo:str
    class Config:
        orm_mode = True

class NganHang(BaseModel):
    id_doitac: int
    tenNganHang:str
    sotaikhoan:str
    chinhanh:str
    chuTaikhoan:str




def create_access_token(data:dict,expires_delta:timedelta):
    to_encode=data.copy()
    expire=datetime.utcnow()+expires_delta
    to_encode.update({"exp":expire})
    encoded_jwt=jwt.encode(to_encode,SECRET_KEY,algorithm=ALGORITHM)
    return encoded_jwt

def get_user_by_username(db:Session,username:str):
    print(username)
    
    return db.query(models.TaiKhoan).filter(models.TaiKhoan.username==username).first()

    
#Function to verify password
def verify_password(plain_password,hashed_password):
    return pwd_context.verify(plain_password,hashed_password)

def authenticate_user(db:Session,username:str,password:str ):
    print(username)
    print(password)
    user=get_user_by_username(db,username)
    print(user)
    if not user or not verify_password(password,user.hashed_password):
        return False
    print(user)
    return user


    

def create_user(db:Session,user:TaiKhoan_CreateBase):
    db_user=models.TaiKhoan(username=user.username,email=user.email,vaitro=user.vaitro,tinhtrang=user.tinhtrang,hashed_password=user.password)
    db.add(db_user)
    db.commit()
    db.refresh(db_user)
    return db_user

def validate_token_and_exact_user_id(token:str) ->int :
    try:
        print(token)
        decoded_token=jwt.decode(token,"secret_key",algorithms=ALGORITHM)
        user_id=decoded_token.get("sub")
        print(decoded_token)
        if user_id is None:
            raise ValueError("Không tìm thấy ID người dùng !")
        return user_id
    except JWTError:
        raise HTTPException(
            status_code=status.HTTP_401_UNAUTHORIZED,
            detail="Token hết hạn! ")
    except ValueError:
        raise HTTPException(
            status_code=status.HTTP_401_UNAUTHORIZED,
            detail="Token không hợp lệ! ")
    except jwt.ExpiredSignatureException:
        raise HTTPException(
            status_code=status.HTTP_401_UNAUTHORIZED,
            detail="Token hết hạn! ")
def getAccountbyID(db:Session,user_id):
    print(">>>KJKJKJKJKJ")
    print(user_id)
    account= db.query(models.NguoiDung).filter(models.NguoiDung.id_taikhoan==user_id).first()
    return account

def validate_token_and_extract_username(token: str) -> str:
    try:
        decoded_token = jwt.decode(token, SECRET_KEY, algorithms=[ALGORITHM])
        username = decoded_token.get("sub")
        print(decoded_token)
        print(username)
        if username is None:
            raise ValueError("Không tìm thấy tên người dùng!")
        return username
    except JWTError:
        raise HTTPException(
            status_code=status.HTTP_401_UNAUTHORIZED,
            detail="Token hết hạn hoặc không hợp lệ!"
        )

def get_account_by_username(db: Session, username: str):
    return db.query(models.TaiKhoan).filter(models.TaiKhoan.username == username).first()

db_dependency=Annotated[Session,Depends(get_db)]
# TẠO TÀI KHOẢN
# @app.post("/users/DangKy",status_code=status.HTTP_201_CREATED)
# async def DangKyTaiKhoan(user:TaiKhoanBase,db:db_dependency):
#     db_user=models.TaiKhoan(**user.dict())
#     db.add(db_user)
#     db.commit()
  

#ENDPOINTS 
@app.post("/user/register",response_model=TaiKhoan)
async def DangKyTaiKhoan(user:TaiKhoan_CreateBase,db:db_dependency ):
    db_user=get_user_by_username(db,username=user.username)
    if db_user:
        raise HTTPException(status_code=400,detail="Tên tài khoản đã tồn tại")
    user.password =pwd_context.hash(user.password)
    return create_user(db=db,user=user)
    
@app.post("/user/login",response_model=Token)
async def login_for_access_token(form_data:OAuth2PasswordRequestForm = Depends(), db:Session=Depends(get_db)):
    user=authenticate_user(db,form_data.username,form_data.password)
    if not user:
        raise HTTPException(status_code=404,details="Sai tài khoản/ mật khẩu")
    access_token_expires=timedelta(minutes=ACCESS_TOKEN_EXPIRE_MINUTES)
    access_token=create_access_token(data={"sub":form_data.username},expires_delta=access_token_expires)
    return{"access_token":access_token, "token_type":"bearer"} 




@app.get("/users/userid={user_id}",status_code=status.HTTP_200_OK)
async def TimKiemTaiKhoanTheoID(user_id:int,db:db_dependency):
    user=db.query(models.TaiKhoan).filter(models.TaiKhoan.id==user_id).first()
    if  user is None:
        raise HTTPException(status_code=404,detail="Không tìm thấy tài khoản")
    return user


@app.post("/nguoidung/create",status_code=status.HTTP_201_CREATED)

async def TaoNguoiDung(account:NguoiDungBase,db:db_dependency):
    existing_nguoi_dung = db.query(models.NguoiDung).filter_by(id_taikhoan=account.id_taikhoan).first()
    if existing_nguoi_dung:
        raise HTTPException(status_code=400, detail="Người dùng đã tồn tại")
    db_user = db.query(models.TaiKhoan).filter(models.TaiKhoan.id == account.id_taikhoan).first()
    if db_user is None:
        raise HTTPException(status_code=400, detail="id người dùng không tồn tại")
    if db_user.vaitro != "KH":
        raise HTTPException(status_code=400, detail="Vai trò của tài khoản không phải là KH")
    db_account=models.NguoiDung(**account.dict())
    db.add(db_account)
    db.commit()

# @app.get("/user/info",response_model=NguoiDungBase)

# Lấy bằng username ( token )
# async def ThongTinCaNhan(token:str =Depends(oauth2_scheme),db:Session=Depends(get_db)):

#     user_id=validate_token_and_exact_user_id(token)
#     print(user_id)
#     user=getAccountbyID(db,user_id)
#     if user is None:
#         raise HTTPException(status_code=404,detail="Không tìm thấy người dùng")
#     return user



@app.get("/users/info/userid={user_id}",status_code=status.HTTP_200_OK)
async def TimKiemTaiKhoanTheoID(user_id:int,db:db_dependency):
    info=db.query(models.NguoiDung).filter(models.NguoiDung.id_taikhoan==user_id).first()
    if  info is None:
        raise HTTPException(status_code=404,detail="Không tìm thấy tài khoản")
    return info

@app.post("/user/change-password", status_code=status.HTTP_200_OK)
async def doi_mat_khau(password_change_request: PasswordChangeRequest, token: Annotated[str, Depends(oauth2_scheme)], db: db_dependency):
    username = validate_token_and_extract_username(token)
    user = get_user_by_username(db, username)
    if not user or not verify_password(password_change_request.old_password, user.hashed_password):
        raise HTTPException(status_code=400, detail="Mật khẩu hiện tại không đúng")
    user.hashed_password = pwd_context.hash(password_change_request.new_password)
    db.commit()
    return {"msg": "Đổi mật khẩu thành công"}

