package com.example.purchase_service.api.model;

import java.math.BigDecimal;
import java.util.Date;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;

@Entity
@Table(name = "hoadon")
public class hoadon {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "ID")
    private int ID;

    @Column(name = "IDTaiKhoan")
    private Integer IDTaiKhoan;

    @Column(name = "IDVe")
    private Integer IDVe;

    @Column(name = "IDKhuyenMai")
    private Integer IDKhuyenMai;

    @Column(name = "ThoiDiemThanhToan")
    private Date ThoiDiemThanhToan;

    @Column(name = "HinhThucThanhToan")
    private String HinhThucThanhToan;

    @Column(name = "ThanhTien")
    private BigDecimal ThanhTien;

    @Column(name = "DaHuy")
    private int DaHuy;

    public hoadon() {
    }

    public hoadon(int iD, Integer iDTaiKhoan, Integer iDVe, Integer iDKhuyenMai, Date thoiDiemThanhToan,
            String hinhThucThanhToan,
            BigDecimal thanhTien, int daHuy) {
        this.ID = iD;
        this.IDTaiKhoan = iDTaiKhoan;
        this.IDVe = iDVe;
        this.IDKhuyenMai = iDKhuyenMai;
        this.ThoiDiemThanhToan = thoiDiemThanhToan;
        this.HinhThucThanhToan = hinhThucThanhToan;
        this.ThanhTien = thanhTien;
        this.DaHuy = daHuy;
    }

    public int getID() {
        return this.ID;
    }

    public Integer getIDTaiKhoan() {
        return this.IDTaiKhoan;
    }

    public Integer getIDVe() {
        return this.IDVe;
    }

    public Integer getIDKhuyenMai() {
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

    public void setID(int iD) {
        this.ID = iD;
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

}
