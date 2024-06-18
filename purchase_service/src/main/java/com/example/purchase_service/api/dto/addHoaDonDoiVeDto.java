package com.example.purchase_service.api.dto;

import java.util.Date;

public class addHoaDonDoiVeDto {
    private int IDNguoiDung;
    private int IDVeMoi;
    private int IDVeCu;
    private Date ThoiDiemThanhToan;
    private String HinhThucThanhToan;

    public String getHinhThucThanhToan() {
        return HinhThucThanhToan;
    }

    public void setHinhThucThanhToan(String hinhThucThanhToan) {
        HinhThucThanhToan = hinhThucThanhToan;
    }

    public Date getThoiDiemThanhToan() {
        return ThoiDiemThanhToan;
    }

    public void setThoiDiemThanhToan(Date thoiDiemThanhToan) {
        ThoiDiemThanhToan = thoiDiemThanhToan;
    }

    public int getIDNguoiDung() {
        return IDNguoiDung;
    }

    public void setIDNguoiDung(int iDNguoiDung) {
        IDNguoiDung = iDNguoiDung;
    }

    public int getIDVeMoi() {
        return IDVeMoi;
    }

    public void setIDVeMoi(int iDVeMoi) {
        IDVeMoi = iDVeMoi;
    }

    public int getIDVeCu() {
        return IDVeCu;
    }

    public void setIDVeCu(int iDVeCu) {
        IDVeCu = iDVeCu;
    }

}
