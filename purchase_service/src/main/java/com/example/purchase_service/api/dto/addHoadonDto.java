package com.example.purchase_service.api.dto;

import java.math.BigDecimal;
import java.util.Date;

public class addHoadonDto {
    private int IDTaiKhoan;

    private int IDVe;

    private int IDSuKien;

    private int IDDoiTac;

    private int IDKhuyenMai;

    private Date ThoiDiemThanhToan;

    private String HinhThucThanhToan;

    private BigDecimal ThanhTien;

    private int DaHuy;

    public int getIDTaiKhoan() {
        return this.IDTaiKhoan;
    }

    public int getIDVe() {
        return this.IDVe;
    }

    public int getIDKhuyenMai() {
        return this.IDKhuyenMai;
    }

    public Date getThoiDiemThanhToan() {
        return this.ThoiDiemThanhToan;
    }

    public String getHinhThucThanhToan() {
        return this.HinhThucThanhToan;
    }

    public BigDecimal getThanhTien() {
        return this.ThanhTien;
    }

    public int getDaHuy() {
        return this.DaHuy;
    }

    public void setIDTaiKhoan(int iDTaiKhoan) {
        this.IDTaiKhoan = iDTaiKhoan;
    }

    public void setIDVe(int iDVe) {
        this.IDVe = iDVe;
    }

    public void setIDKhuyenMai(int iDKhuyenMai) {
        this.IDKhuyenMai = iDKhuyenMai;
    }

    public void setThoiDiemThanhToan(Date thoiDiemThanhToan) {
        this.ThoiDiemThanhToan = thoiDiemThanhToan;
    }

    public void setHinhThucThanhToan(String hinhThucThanhToan) {
        this.HinhThucThanhToan = hinhThucThanhToan;
    }

    public void setThanhTien(BigDecimal thanhTien) {
        this.ThanhTien = thanhTien;
    }

    public void setDaHuy(int daHuy) {
        this.DaHuy = daHuy;
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
