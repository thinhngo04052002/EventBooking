import models 
from database import engine,SessionLocal
from sqlalchemy.orm import Session
from jose import jwt,JWTError
from passlib.context import CryptContext
from fastapi.security import OAuth2PasswordBearer,OAuth2PasswordRequestForm
from datetime import timedelta,datetime
import uvicorn
from fastapi import FastAPI,HTTPException,Depends,status
from pydantic import BaseModel
from  typing import Annotated, List, Optional
app=FastAPI()

#create all database tables 
models.Base.metadata.create_all(bind=engine)

def get_db():
    db=SessionLocal()
    try:
        yield db
    finally:
        db.close()

#SCHEMA RETURNS
class EventRevenueCreate(BaseModel):
    id_doitac: int
    id_sukien: int
    id_loaive: int
    soluong: int
    soluongdaban: int
    giave: int

class EventRevenueOut(EventRevenueCreate):
    tonggiatri:int
    tongthu: int
    chitra:float
    class Config:
        orm_mode = True

@app.post("/create_event_revenue/", response_model=EventRevenueOut)
def create_event_revenue(event_revenue: EventRevenueCreate):
    db = SessionLocal()
    new_event_revenue = models.eventRevenue(
        id_doitac=event_revenue.id_doitac,
        id_sukien=event_revenue.id_sukien,
        id_loaive=event_revenue.id_loaive,
        soluong=event_revenue.soluong,
        soluongdaban=event_revenue.soluongdaban,
        giave=event_revenue.giave
    )
    db.add(new_event_revenue)
    try:
        db.commit()
        db.refresh(new_event_revenue)
        return new_event_revenue
    except Exception as e:
        db.rollback()
        raise HTTPException(status_code=400, detail=f"An error occurred: {str(e)}")
    finally:
        db.close()