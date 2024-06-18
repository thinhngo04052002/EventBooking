package com.example.purchase_service.api.dto;

import java.util.Date;

public class addHoaDonMuaVeDto {
    private int IDTaiKhoan;

    private int IDVe;

    private int IDKhuyenMai;

    private Date ThoiDiemThanhToan;

    private String HinhThucThanhToan;

    public int getIDTaiKhoan() {
        return IDTaiKhoan;
    }

    public void setIDTaiKhoan(int iDTaiKhoan) {
        IDTaiKhoan = iDTaiKhoan;
    }

    public int getIDVe() {
        return IDVe;
    }

    public void setIDVe(int iDVe) {
        IDVe = iDVe;
    }

    public int getIDKhuyenMai() {
        return IDKhuyenMai;
    }

    public void setIDKhuyenMai(int iDKhuyenMai) {
        IDKhuyenMai = iDKhuyenMai;
    }

    public Date getThoiDiemThanhToan() {
        return ThoiDiemThanhToan;
    }

    public void setThoiDiemThanhToan(Date thoiDiemThanhToan) {
        ThoiDiemThanhToan = thoiDiemThanhToan;
    }

    public String getHinhThucThanhToan() {
        return HinhThucThanhToan;
    }

    public void setHinhThucThanhToan(String hinhThucThanhToan) {
        HinhThucThanhToan = hinhThucThanhToan;
    }
}
