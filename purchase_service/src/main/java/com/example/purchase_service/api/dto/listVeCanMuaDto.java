package com.example.purchase_service.api.dto;

import java.util.HashMap;
import java.util.Map;

public class listVeCanMuaDto {
    private int IDSuatDien;
    private int IDSuKien;
    private int IDDoiTac;
    private Map<Integer, Integer> loaiVe_soLuong = new HashMap<>();

    public int getIDSuatDien() {
        return IDSuatDien;
    }

    public void setIDSuatDien(int iDSuatDien) {
        IDSuatDien = iDSuatDien;
    }

    public int getIDSuKien() {
        return IDSuKien;
    }

    public void setIDSuKien(int iDSuKien) {
        IDSuKien = iDSuKien;
    }

    public int getIDDoiTac() {
        return IDDoiTac;
    }

    public void setIDDoiTac(int iDDoiTac) {
        IDDoiTac = iDDoiTac;
    }

    public Map<Integer, Integer> getLoaiVe_soLuong() {
        return loaiVe_soLuong;
    }

    public void setLoaiVe_soLuong(Map<Integer, Integer> loaiVe_soLuong) {
        this.loaiVe_soLuong = loaiVe_soLuong;
    }
}
