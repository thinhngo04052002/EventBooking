from sqlalchemy import Column, Integer, String,Float, ForeignKey,CheckConstraint,Date,UniqueConstraint, Computed
from sqlalchemy.orm import relationship
from sqlalchemy.ext.declarative import declarative_base

Base = declarative_base()

class eventRevenue(Base):
    __tablename__ = 'eventRevenue'
    id = Column(Integer, primary_key=True, index=True, autoincrement=True)
    id_doitac = Column(Integer, index=True)
    id_sukien = Column(Integer, index=True)
    id_loaive = Column(Integer, index=True)
    soluong = Column(Integer)
    soluongdaban = Column(Integer)
    giave = Column(Integer)
    tonggiatri = Column(Integer, Computed('soluong * giave'))
    tongthu = Column(Integer, Computed('soluongdaban * giave'))
    chitra = Column(Float, Computed('tonggiatri * 0.2'))
    __table_args__ = (
        UniqueConstraint('id_doitac', 'id_sukien', 'id_loaive', name='unique_id_tai_khoan'),
    )



class systemRenevue(Base):
    __tablename__ = 'systemRenevue'
    id = Column(Integer, primary_key=True, index=True,autoincrement=True)
    year=Column(Integer)
    month=Column(Integer)
    tongThuNhap=Column(Integer)
    __table_args__ = (
        UniqueConstraint('year','month', name='unique_id_tai_khoan'),)

 