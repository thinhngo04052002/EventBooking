from pydantic import BaseModel 
from datetime import datetime
from typing import List

class Message_YC(BaseModel):
    ThoiGian: datetime
    NoiDung: str
    NguoiGoi: int
    
class YC(BaseModel):
    IDNguoiDung: int
    TinNhan: List[Message_YC]

class DanhGia(BaseModel):
    ID: int
    IDSukien: int
    IDTaiKhoan: int
    SoSao: str
    phanhoi: str
    IDDoiTac: int

class PhanHoi(BaseModel):
    ID: int
    IDSukien: int
    IDTaiKhoan: int
    phanhoi: str 
    IDDoiTac: int

class sosao(BaseModel):
    ID: int
    IDSukien: int
    IDTaiKhoan: int
    SoSao: int
    IDDoiTac: int
