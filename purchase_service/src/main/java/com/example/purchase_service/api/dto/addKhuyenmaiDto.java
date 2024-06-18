package com.example.purchase_service.api.dto;

public class addKhuyenmaiDto {
    private int idsukien;

    private int chietkhau;

    private String makhuyenmai;

    public int getIdsukien() {
        return this.idsukien;
    }

    public int getChietkhau() {
        return this.chietkhau;
    }

    public String getMakhuyenmai() {
        return this.makhuyenmai;
    }

    public void setIdsukien(int idsukien) {
        this.idsukien = idsukien;
    }

    public void setChietkhau(int chietkhau) {
        this.chietkhau = chietkhau;
    }

    public void setMakhuyenmai(String makhuyenmai) {
        this.makhuyenmai = makhuyenmai;
    }

}
