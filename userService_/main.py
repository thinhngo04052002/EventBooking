from fastapi import FastAPI,HTTPException,Depends,status
from pydantic import BaseModel
from  typing import Annotated, List, Optional
import models
from database import engine,SessionLocal
from sqlalchemy.orm import Session
from jose import jwt, JWTError 
from passlib.context import CryptContext
from fastapi.security import OAuth2PasswordBearer,OAuth2PasswordRequestForm
from datetime import timedelta,datetime
import uvicorn
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
class TaiKhoan_login(BaseModel):
    username: str
    password: str
    class Config:
        orm_mode = True


class TaiKhoan(TaiKhoanBase):
    id:int 
    class Config:
        orm_mode = True
class Token(BaseModel):
    access_token:str
    token_type:str
    role:str
    id: int
    username:str

class TaiKhoanList(BaseModel):
    id: int
    username: str
    email: str
    vaitro: str
    tinhtrang: str

    class Config:
        orm_mode = True


class TaiKhoanUpdateStatus(BaseModel):
    tinhtrang: str

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


class DoiTacBase(BaseModel):
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
class NguoiDungUpdate(BaseModel):
    hoten: Optional[str] = None
    gioitinh: Optional[str] = None
    ngaysinh: Optional[str] = None
    sdt: Optional[str] = None
    diachi: Optional[str] = None
    class Config:
        orm_mode = True

class DoiTacUpdate(BaseModel):
    tendoitac: Optional[str] = None
    sdt: Optional[str] = None
    diachi: Optional[str] = None
    email: Optional[str] = None
    nguoidaidien: Optional[str] = None
    masothue: Optional[str] = None
    logo: Optional[str] = None

    class Config:
        orm_mode = True


class NganHangBase(BaseModel):
    id_doitac: int
    tenNganhang:str
    sotaikhoan:str
    chinhanh:str
    chuTaikhoan:str




def create_access_token(data:dict,expires_delta:timedelta):
    to_encode=data.copy()
    expire = datetime.utcnow() + timedelta(hours=4)  # Thời hạn là 4 tiếng
    to_encode.update({"exp":expire})
    encoded_jwt=jwt.encode(to_encode,SECRET_KEY,algorithm=ALGORITHM)
    return encoded_jwt

def get_user_by_username(db:Session,username:str):
    print(username)
    
    return db.query(models.TaiKhoan).filter(models.TaiKhoan.username==username).first()
def get_user_id_by_username(db: Session, username: str) -> int:
    user = db.query(models.TaiKhoan).filter(models.TaiKhoan.username == username).first()
    if user:
        return user.id
    return None

    
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
#     db.
# commit()
  


#ENDPOINTS 
def get_all_taikhoan(db: Session):
    return db.query(models.TaiKhoan).all()

def get_user_by_id(db:Session, id:int):
    user= db.query(models.TaiKhoan).filter(models.TaiKhoan.id==id).all()
    if user is None:
        raise HTTPException(status_code=400, detail="id người dùng không tồn tại")
    return user


@app.get("/taikhoan/listALL", response_model=List[TaiKhoanList])
async def DanhSachTaiKhoan( db: Session = Depends(get_db)):
    list = get_all_taikhoan(db)
    return list




@app.post("/taikhoan/register",response_model=TaiKhoan)
async def DangKyTaiKhoan(user:TaiKhoan_CreateBase,db:db_dependency ):
    db_user=get_user_by_username(db,username=user.username)
    if db_user:
        raise HTTPException(status_code=400,detail="Tên tài khoản đã tồn tại")
    user.password =pwd_context.hash(user.password)
    return create_user(db=db,user=user)
    
@app.post("/taikhoan/login",response_model=Token)
async def login_for_access_token(login_form:TaiKhoan_login, db:db_dependency):
    user=authenticate_user(db,login_form.username,login_form.password)

    if not user :
        raise HTTPException(status_code=404,details="Sai tài khoản/ mật khẩu")
    if user.tinhtrang=='Bị khoá':
        raise HTTPException(status_code=500,details="Tài khoản bị khoá")

    access_token_expires=timedelta(minutes=ACCESS_TOKEN_EXPIRE_MINUTES)
    access_token=create_access_token(data={"sub":user.id},expires_delta=access_token_expires)
    return{"access_token":access_token, "token_type":"bearer","role":user.vaitro,"id":user.id,"username":user.username} 




@app.get("/taikhoan/search/userid={user_id}",status_code=status.HTTP_200_OK)
async def TimKiemTaiKhoanTheoID(user_id:int,db:db_dependency):
    user=db.query(models.TaiKhoan).filter(models.TaiKhoan.id==user_id).first()
    if  user is None:
        raise HTTPException(status_code=404,detail="Không tìm thấy tài khoản")
    return user

@app.delete("/taikhoan/delete/id={user_id}",status_code=status.HTTP_200_OK)
async def XoaTaiKhoan(user_id:int,db:db_dependency):
    user=db.query(models.TaiKhoan).filter(models.TaiKhoan.id==user_id).first()
    if  user is None:
        raise HTTPException(status_code=404,detail="Không tìm thấy tài khoản")
    nguoidung=db.query(models.NguoiDung).filter(models.NguoiDung.id_taikhoan==user_id).first()
    doitac=db.query(models.DoiTac).filter(models.DoiTac.id_taikhoan==user_id).first()

    if nguoidung:
        db.delete(nguoidung)
        print("Đã xoá người dùng")
    if doitac:
        db.delete(doitac)
        print("Đã xoá đối tác")
    print(user)
    db.delete(user)
    db.commit()





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




@app.get("/nguoidung/info/userid={user_id}",status_code=status.HTTP_200_OK)
async def ThongtinNguoiDungTheoID(user_id:int,db:db_dependency):
    info=db.query(models.NguoiDung).filter(models.NguoiDung.id_taikhoan==user_id).first()
    if  info is None:
        raise HTTPException(status_code=404,detail="Không tìm thấy tài khoản")
    return info

@app.post("/taikhoan/changepassword", status_code=status.HTTP_200_OK)
async def doi_mat_khau(password_change_request: PasswordChangeRequest, token: Annotated[str, Depends(oauth2_scheme)], db: db_dependency):
    username = validate_token_and_extract_username(token)
    user = get_user_by_username(db, username)
    if not user or not verify_password(password_change_request.old_password, user.hashed_password):
        raise HTTPException(status_code=400, detail="Mật khẩu hiện tại không đúng")
    user.hashed_password = pwd_context.hash(password_change_request.new_password)
    db.commit()
    return {"msg": "Đổi mật khẩu thành công"}

@app.post("/doitac/create",status_code=status.HTTP_201_CREATED)
async def TaoDoiTac(doitac:DoiTacBase,db:db_dependency):
    existing_nguoi_dung = db.query(models.DoiTac).filter_by(id_taikhoan=doitac.id_taikhoan).first()
    if existing_nguoi_dung:
        raise HTTPException(status_code=400, detail="Tài khoản đã là đối tác")
    db_user = db.query(models.TaiKhoan).filter(models.TaiKhoan.id == doitac.id_taikhoan).first()
    if db_user is None:
        raise HTTPException(status_code=400, detail="id người dùng không tồn tại")
    if db_user.vaitro != "ADDVSK":
        raise HTTPException(status_code=400, detail="Vai trò của tài khoản không phải là KH")
    db_account=models.DoiTac(**doitac.dict())
    db.add(db_account)
    db.commit()

@app.post("/doitac/nganhang/create",status_code=status.HTTP_201_CREATED)
async def ThietLapNganHang(nganhang:NganHangBase,db:db_dependency):
    existing_doitac = db.query(models.NganHang).filter_by(id_doitac =nganhang.id_doitac).first()
    if existing_doitac:
        raise HTTPException(status_code=400, detail="Đối tác đã đăng ký ngân hàng")
    print("0K")
    db_doitac = db.query(models.DoiTac).filter(models.DoiTac.id == nganhang.id_doitac).first()
    print("OK2")
    if db_doitac is None:
        raise HTTPException(status_code=400, detail="Kiểm tra lại ID đối tác")
    print("OK3")
    db_bank=models.NganHang(**nganhang.dict())
    db.add(db_bank)
    db.commit()




@app.get("/doitac/info/id={doitac_id}",status_code=status.HTTP_200_OK)
async def ThongtinNguoiDungTheoID(doitac_id:int,db:db_dependency):
    info=db.query(models.DoiTac).filter(models.DoiTac.id==doitac_id).first()
    if  info is None:
        raise HTTPException(status_code=404,detail="Không tìm thấy thông tin")
    return info

@app.get("/doitac/info/idtaikhoan={id_taikhoan}",status_code=status.HTTP_200_OK)
async def ThongtinNguoiDungTheoIDTaiKhoan(id_taikhoan:int,db:db_dependency):
    info=db.query(models.DoiTac).filter(models.DoiTac.id_taikhoan==id_taikhoan).first()
    if  info is None:
        raise HTTPException(status_code=404,detail="Không tìm thấy thông tin")
    return info


def update_taikhoan_status(db: Session, user_id: int, status: str):
    taikhoan = db.query(models.TaiKhoan).filter(models.TaiKhoan.id == user_id).first()
    if not taikhoan:
        return None
    taikhoan.tinhtrang = status
    db.commit()
    db.refresh(taikhoan)
    return taikhoan

@app.put("/taikhoan/update_status/id={user_id}", response_model=TaiKhoanList)
async def update_taikhoan_tinhtrang(user_id: int, status: TaiKhoanUpdateStatus, db: Session = Depends(get_db)):
    updated_user = update_taikhoan_status(db, user_id, status.tinhtrang)
    if updated_user is None:
        raise HTTPException(status_code=404, detail="Không tìm thấy tài khoản")
    return updated_user


def update_doitac(db: Session, doitac_id: int, update_data: DoiTacUpdate):
    doitac = db.query(models.DoiTac).filter(models.DoiTac.id == doitac_id).first()
    if not doitac:
        return None

    for key, value in update_data.dict(exclude_unset=True).items():
        setattr(doitac, key, value)
    
    db.commit()
    db.refresh(doitac)
    return doitac


@app.put("/doitac/update/id={doitac_id}", response_model=DoiTacBase)
async def update_doitac_endpoint(doitac_id: int, update_data: DoiTacUpdate, db: Session = Depends(get_db)):
    updated_doitac = update_doitac(db, doitac_id, update_data)
    if updated_doitac is None:
        raise HTTPException(status_code=404, detail="Không tìm thấy đối tác")
    return updated_doitac

def update_nguoidung(db:Session, user_id:int, update_data:NguoiDungUpdate):
    nguoidung=db.query(models.NguoiDung).filter(models.NguoiDung.id_taikhoan==user_id).first()
    if not nguoidung:
        return None
    for key,value in update_data.dict(exclude_unset=True).items():
        setattr(nguoidung,key,value)
    db.commit()
    db.refresh(nguoidung)
    return nguoidung

@app.put("/nguoidung/update/user_id={user_id}", response_model=NguoiDungBase)
async def update_doitac_endpoint(user_id: int, update_data: NguoiDungUpdate, db: Session = Depends(get_db)):
    updated_nguoidung = update_doitac(db, user_id, update_data)
    if updated_nguoidung is None:
        raise HTTPException(status_code=404, detail="Không tìm thấy đối tác")
    return update_nguoidung

if __name__ == "__main__":
    uvicorn.run(app, port=8006)  # Change the port here to 8006