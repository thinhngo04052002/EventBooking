from fastapi import FastAPI,HTTPException,Depends,status
from pydantic import BaseModel
from  typing import Annotated
import  models 
from database import engine,SessionLocal
from sqlalchemy.orm import Session

app=FastAPI()
models.Base.metadata.create_all(bind=engine)


class taiKhoanBase(BaseModel):
    taikhoan:str
    matkhau:str
    email:str
    vaitro:str
    tinhtrang:str

class nguoiDungBase(BaseModel):
    hoten:str
    sdt:str
    diachi:str
    gioitinh:str
    ngaysinh:str
    diachi:str
    idTaiKhoan:int

def get_db():
    db=SessionLocal()
    try:
        yield db
    finally:
        db.close()

db_dependency=Annotated[Session,Depends(get_db)]
## TẠO TÀI KHOẢN
@app.post("/users/DangKy",status_code=status.HTTP_201_CREATED)
async def DangKyTaiKhoan(user:taiKhoanBase,db:db_dependency):
    db_user=models.TaiKhoan(**user.dict())
    db.add(db_user)
    db.commit()

##TÌM TÀI KHOẢN THEO ID 
@app.get("/users/userid={user_id}",status_code=status.HTTP_200_OK)
async def TimKiemTaiKhoanTheoID(user_id:int,db:db_dependency):
    user=db.query(models.TaiKhoan).filter(models.TaiKhoan.id==user_id).first()
    if user is None:
        raise HTTPException(status_code=404,detail="Không tìm thấy tài khoản")
    return user

