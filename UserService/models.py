from sqlalchemy import Boolean, String, Integer, Column
from database import Base

#Tạo class User
class User(Base):
    __tablename__ = 'users'

