from sqlalchemy import CHAR,Boolean, CheckConstraint, String, Integer, Column,Date
from database import Base

#Tạo class TaiKhoan
class TaiKhoan(Base):
    __tablename__ = 'taikhoan'
    id=Column(Integer,primary_key=True,index=True,autoincrement=True)
    taikhoan=Column(String(50),unique=True)
    matkhau=Column(String(50))
    email=Column(String(50))
    vaitro = Column(String(50), CheckConstraint("vaitro IN ('KH', 'ADNT', 'ADDVSK')"))
    tinhtrang=Column(String(50),CheckConstraint("tinhtrang IN ('Hoạt động','Bị Khoá')"))

class NguoiDung(Base):
    __tablename__ = 'nguoidung'
    id=Column(Integer,primary_key=True,index=True,autoincrement=True)
    idTaiKhoan=Column(Integer)
    hoten=Column(String(100))
    gioitinh=Column(String(5),CheckConstraint("gioitinh IN ('Nam','Nữ')"))
    ngaysinh=Column(Date)
    sdt=Column(String(10))
    diachi=Column(String(500))




