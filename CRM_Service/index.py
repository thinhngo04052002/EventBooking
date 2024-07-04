import uvicorn
from fastapi import FastAPI
from routes.routes import note


app= FastAPI()
app.include_router(note)

if __name__ == "__main__":
    uvicorn.run(app, port=8004, reload= True)  # Thay đổi cổng ở đây
