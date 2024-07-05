def DanhGiaEntity(item) -> dict:
    return {
        "id":str(item["_id"]),
        "ID": int(item["ID"]),
        "IDSukien": int(item["IDSukien"]),
        "IDTaiKhoan": int(item["IDTaiKhoan"]),
        "SoSao": str(item["SoSao"]),
        "phanhoi": str(item["phanhoi"]),
        "IDDoiTac": int(item["IDDoiTac"]),
    }

def DanhGiasEntity(entity) -> list:
    return [DanhGiaEntity(item) for item in entity]


def PhanHoiEntity(item1) -> dict:
    return {
        "id":str(item1["_id"]),
        "ID": int(item1["ID"]),
        "IDSukien": int(item1["IDSukien"]),
        "IDTaiKhoan": int(item1["IDTaiKhoan"]),
        "phanhoi": str(item1["phanhoi"]),
        "IDDoiTac": int(item1["IDDoiTac"]),
    }

def PhanHoisEntity(entity1) -> list:
    return [PhanHoiEntity(item1) for item1 in entity1]


def SoSaoEntity(item2) -> dict:
    return {
        "id":str(item2["_id"]),
        "ID": int(item2["ID"]),
        "IDSukien": int(item2["IDSukien"]),
        "IDTaiKhoan": int(item2["IDTaiKhoan"]),
        "SoSao": str(item2["SoSao"]),
        "IDDoiTac": int(item2["IDDoiTac"]),
    }

def SoSaosEntity(entity2) -> list:
    return [SoSaoEntity(item2) for item2 in entity2]


