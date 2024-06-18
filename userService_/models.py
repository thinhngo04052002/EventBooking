from sqlalchemy import Column, Integer, String, ForeignKey,CheckConstraint,Date,UniqueConstraint
from sqlalchemy.orm import relationship
from sqlalchemy.ext.declarative import declarative_base

Base = declarative_base()

class TaiKhoan(Base):
    __tablename__ = 'taikhoan'
    id = Column(Integer, primary_key=True, index=True,autoincrement=True)
    username = Column(String(50), unique=True, nullable=False,index=True)
    # password = Column(String(50), nullable=False)
    email=Column(String(50))
    vaitro = Column(String(50), CheckConstraint("vaitro IN ('KH', 'ADNT', 'ADDVSK')"),nullable=False)
    tinhtrang=Column(String(50),CheckConstraint("tinhtrang IN ('Hoạt động','Bị Khoá')"),nullable=False)
    hashed_password = Column(String(200),nullable=False)
    nguoidung = relationship("NguoiDung", back_populates="taikhoan")

class NguoiDung(Base):
    __tablename__ = 'nguoidung'
    id = Column(Integer, primary_key=True, index=True,autoincrement=True)
    hoten = Column(String(100), nullable=False)
    id_taikhoan = Column(Integer, ForeignKey("taikhoan.id",ondelete='CASCADE'),nullable=False)
    gioitinh=Column(String(5),CheckConstraint("gioitinh IN ('Nam','Nữ')"),nullable=False)
    ngaysinh=Column(Date,nullable=False)
    sdt=Column(String(10),nullable=False)
    diachi=Column(String(500),nullable=False)
    taikhoan = relationship("TaiKhoan", back_populates="nguoidung")
    __table_args__ = (
        UniqueConstraint('id_taikhoan', name='unique_id_tai_khoan'),
    )