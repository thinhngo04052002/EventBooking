from fastapi import APIRouter, Depends
from fastapi import HTTPException
from models.models import Message_YC, DanhGia, YC, PhanHoi, sosao
from schemas.schema import DanhGiaEntity, DanhGiasEntity, SoSaoEntity, SoSaosEntity
from config.db import conn
from bson import ObjectId
from typing import List


note= APIRouter()

## Đánh giá

@note.get("/get_all_info/")
async def get_all_info():
    """
    Lấy danh sách các đánh giá.
 
    Returns:
        list: A list of danhgia records as JSON objects.
    """
 
    # Truy vấn và trả ra kết quả.
    Dgs= DanhGiasEntity(conn.UDPT.DanhGia.find())
 
    # Nếu đánh giá không tồn tại thì thông báo.
    if not Dgs:
       raise HTTPException(status_code=404, detail="Không tìm thấy đánh giá")
 
    return Dgs

@note.get("/get_danhgia_by_idsk/")
async def get_danhgia_by_idsk(idsk: int):
    """
    Lấy đánh giá theo idsk.
 
    Args:
        idsk (int): The id of an event.
 
    Returns:
        dict: The danhgia record as a JSON object.
    """
 
    # Truy vấn và trả ra kết quả theo idsk
    dg = DanhGiasEntity(conn.UDPT.DanhGia.find({"IDSukien": idsk}))
 
    # Nếu đánh giá không tồn tại thì thông báo.
    if not dg:
        raise HTTPException(status_code=404, detail="Không tìm thấy đánh giá")
 
    return dg

@note.get("/get_danhgia_by_idtk/")
async def get_danhgia_by_idtk(idtk: int):
    """
    Lấy đánh giá theo idtk.
 
    Args:
        idtk (int): The id of an account.
 
    Returns:
        dict: The danhgia record as a JSON object.
    """
 
    # Truy vấn và trả ra kết quả theo idtk.
    dg = DanhGiasEntity(conn.UDPT.DanhGia.find({"IDTaiKhoan": idtk}))
 
    # Nếu đánh giá không tồn tại thì thông báo.
    if not dg:
        raise HTTPException(status_code=404, detail="Không tìm thấy đánh giá")
 
    return dg


@note.post("/create_danhgia/")
async def create_danhgia(dg: DanhGia):
    """
    Tạo một đánh giá mới.
 
    Args:
        danhgia (DanhGia): The danhgia details to be created.
 
    Returns:
        dict: A JSON response with a message indicating the creation status.
    """
    # Kiểm tra id đã tồn tại chưa trong CSDL
    existing_id = conn.UDPT.DanhGia.find_one({"ID": dg.ID})
    if existing_id:
        raise HTTPException(status_code=404, detail="Id này đã tồn tại")
    
    # Thêm một đánh giá mới
    result = conn.UDPT.DanhGia.insert_one(dict(dg))
    return  DanhGiasEntity(conn.UDPT.DanhGia.find())


@note.post("/create_danhgiasosao/")
async def create_danhgiasosao(dg: sosao):
    """
    Tạo một đánh giá mới.
 
    Args:
        danhgia (DanhGia): The danhgia details to be created.
 
    Returns:
        dict: A JSON response with a message indicating the creation status.
    """
    # Kiểm tra id đã tồn tại chưa trong CSDL
    existing_id = conn.UDPT.DanhGia.find_one({"ID": dg.ID})
    if existing_id:
        raise HTTPException(status_code=404, detail="Id này đã tồn tại")
    
    # Thêm một đánh giá mới
    result = conn.UDPT.DanhGia.insert_one(dict(dg))
    return  SoSaosEntity(conn.UDPT.DanhGia.find())


@note.put("/update_danhgia_by_ID/")
async def update_Danhgia_by_ID(id: int, 
                              updated_dg: DanhGia):
    """
    Cập nhật một đánh giá bằng ID.
 
    Args:
        Id (int): The ID of DanhGia to update.
        updated_dg (DanhGia): The updated DanhGia details.
 
    Returns:
        dict: A JSON response with a message indicating the update status.
    """
 
    # Kiểm tra đánh giá có tồn tại trong CSDl
    existing_DanhGia = conn.UDPT.DanhGia.find_one({"ID": id})
    if not existing_DanhGia:
        raise HTTPException(
            status_code=404, detail="Đánh giá không tồn tại")
 
    # Đảm bảo nhập đúng id
    if updated_dg.id != id:
        raise HTTPException(
            status_code=400, detail="Id không đúng")
 
    # Xóa _id ra khỏi trường cần cập nhật
    updated_DanhGia_dict = updated_dg.dict()
    updated_DanhGia_dict.pop('_id', None)

 
    # Cập nhật đánh giá với id cho trước
    conn.UDPT.DanhGia.update_one(
        {"ID": id},
        {"$set": updated_DanhGia_dict}
    )
 
    # Truy vấn lại thông tin đã cập nhật
    updated_DanhGia_doc = conn.UDPT.DanhGia.find_one({"ID": id})
    updated_DanhGia_doc.pop('_id', None)
    print(updated_DanhGia_doc)
 
    return {"Thông báo": f"Đánh giá đã được cập nhật."}



@note.put("/update_phanhoi_by_ID/")
async def update_PhanHoi_by_ID(id: int, 
                              updated_ph: PhanHoi):
    """
    Cập nhật một phản hồi bằng ID.
 
    Args:
        Id (int): The ID of DanhGia to update.
        updated_dg (DanhGia): The updated DanhGia details.
 
    Returns:
        dict: A JSON response with a message indicating the update status.
    """
 
    # Kiểm tra đánh giá có tồn tại trong CSDl
    existing_DanhGia = conn.UDPT.DanhGia.find_one({"ID": id})
    if not existing_DanhGia:
        raise HTTPException(
            status_code=404, detail="Đánh giá không tồn tại")
 
    # Đảm bảo nhập đúng id
    if updated_ph.id != id:
        raise HTTPException(
            status_code=400, detail="Id không đúng")
 
    # Xóa _id ra khỏi trường cần cập nhật
    updated_DanhGia_dict = updated_ph.dict()
    updated_DanhGia_dict.pop('_id', None)

 
    # Cập nhật đánh giá (phản hồi) với id cho trước
    conn.UDPT.DanhGia.update_one(
        {"ID": id},
        {"$set": updated_DanhGia_dict}
    )
 
    # Truy vấn lại thông tin đã cập nhật
    updated_DanhGia_doc = conn.UDPT.DanhGia.find_one({"ID": id})
    updated_DanhGia_doc.pop('_id', None)
    print(updated_DanhGia_doc)
 
    return {"Thông báo": f"Đánh giá đã được cập nhật."}

@note.put("/update_sosao_by_ID/")
async def update_sosao_by_ID(id: int, 
                              updated_ss: sosao):
    """
    Cập nhật số sao bằng ID.
 
    Args:
        Id (int): The ID of DanhGia to update.
        updated_dg (DanhGia): The updated DanhGia details.
 
    Returns:
        dict: A JSON response with a message indicating the update status.
    """
 
    # Kiểm tra đánh giá có tồn tại trong CSDl
    existing_DanhGia = conn.UDPT.DanhGia.find_one({"ID": id})
    if not existing_DanhGia:
        raise HTTPException(
            status_code=404, detail="Đánh giá không tồn tại")
 
    # Đảm bảo nhập đúng id
    if updated_ss.id != id:
        raise HTTPException(
            status_code=400, detail="Id không đúng")
 
    # Xóa _id ra khỏi trường cần cập nhật
    updated_DanhGia_dict = updated_ss.dict()
    updated_DanhGia_dict.pop('_id', None)

 
    # Cập nhật đánh giá (số sao) với id cho trước
    conn.UDPT.DanhGia.update_one(
        {"ID": id},
        {"$set": updated_DanhGia_dict}
    )
 
    # Truy vấn lại thông tin đã cập nhật
    updated_DanhGia_doc = conn.UDPT.DanhGia.find_one({"ID": id})
    updated_DanhGia_doc.pop('_id', None)
    print(updated_DanhGia_doc)
 
    return {"Thông báo": f"Đánh giá đã được cập nhật."}


@note.delete("/delete_danhgia_by_ID/")
async def delete_danhgia(id: int):
    """
    Xóa một đánh giá.
 
    Args:
        id (int): The ID of Danhgia.
 
    Returns:
        dict: A JSON response with a message indicating 
        the deletion status.
    """
 
    # Kiểm tra đánh giá có tồn tại trong CSDl
    existing_employee = conn.UDPT.DanhGia.find({"ID": id})
    if not existing_employee:
        raise HTTPException(
            status_code=404, detail="Đánh giá không tồn tại")
 
    # Nếu đánh giá tồn tại, xóa và thông báo.
    conn.UDPT.DanhGia.delete_one({"ID": id})
 
    return {"Thông báo": f"Đánh giá đã được xóa thành công."}


# Yêu cầu hỗ trợ

# @note.post("/documents/")
# async def create_document(document: YC):
#     # Convert the Pydantic model to a dictionary
#     document_dict = document.dict()

#     # Insert the document into the collection
#     result = conn.UDPT.DanhSachYeucauHoTro.insert_one(document_dict)

#     # Return the inserted document ID
#     return {"document_id": str(result.inserted_id)}

# @note.get("/document1s")
# async def get_all_documents() -> List[dict]:
#     documents = conn.UDPT.DanhSachYeucauHoTro.find()
#     return list(documents)

@note.get("/yc/{id}", response_model=YC)
async def get_yc(id: int):
    yc = conn.UDPT.DanhSachYeucauHoTro.find_one({"IDNguoiDung": id})
    if yc:
        return yc
    else:
        return {"Thông báo": "Không tìm thấy yêu cầu"}


@note.get("/yc", response_model=YC)
async def get_all_yc():
    yc = conn.UDPT.DanhSachYeucauHoTro.find()
    if yc:
        return yc
    else:
        return {"Thông báo": "Không tìm thấy yêu cầu"}
    

# @note.get("/get_data/{id_nguoi_dung}")
# def get_data(id_nguoi_dung: int):
#     # Query the database using the provided ID
#     result = conn.UDPT.DanhSachYeucauHoTro.find_one({"IDNguoiDung": id_nguoi_dung})

#     # Check if the document was found
#     if result:
#         # Return the document as a JSON response
#         return JSONResponse(content=result, status_code=200)
#     else:
#         # Return a JSON response with an error message
#         return JSONResponse(content={"message": "Data not found"}, status_code=404)
use_model = False

@note.get("/data/{user_id}", response_model=YC if use_model else dict, response_description="Get user data")
async def get_data(user_id: int, use_model: bool = False):
    """
    Retrieves user data from MongoDB based on the provided ID.

    Args:
        user_id (int): The user ID to fetch data for.
        use_model (bool, optional): Whether to use the Pydantic data model (default: False).
        db: MongoDB database instance obtained through dependency injection.

    Returns:
        dict or UserData: User data dictionary or Pydantic model instance, depending on `use_model`.
    """

    query = {"IDNguoiDung": user_id}
    result = conn.UDPT.DanhSachYeucauHoTro.find_one(query)

    if not result:
        return {"message": "User data not found"}

    if use_model:
        # Convert result to UserData model
        return YC(**result)
    else:
        # Return raw dictionary representation
        return result