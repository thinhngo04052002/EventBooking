package com.example.purchase_service.api.dto;

import java.util.Date;

public class addHoaDonMuaVeDto {
    private int IDTaiKhoan;

    private int IDVe;

    private int IDSuKien;

    private int IDDoiTac;

    private String MaKhuyenMai;

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

    public String getMaKhuyenMai() {
        return MaKhuyenMai;
    }

    public void setMaKhuyenMai(String maKhuyenMai) {
        MaKhuyenMai = maKhuyenMai;
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

}
