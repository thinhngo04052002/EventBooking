from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker,relationships
from sqlalchemy.ext.declarative import declarative_base

URL_DATABASE='mysql+pymysql://root@localhost:3306/statistic'
engine=create_engine(URL_DATABASE)
SessionLocal=sessionmaker(autocommit=False, autoflush=False, bind=engine)

Base=declarative_base()


