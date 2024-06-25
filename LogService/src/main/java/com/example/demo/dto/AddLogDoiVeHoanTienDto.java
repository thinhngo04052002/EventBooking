package com.example.demo.dto;

import java.math.BigDecimal;

public class AddLogDoiVeHoanTienDto {
    private Integer IdVeCu;
    private Integer IdVeMoi;
    private Integer IdSuKien;
    private Integer IdDoiTac;
    private BigDecimal SoTienHoan;
    private Integer IdKhachHang;

    public Integer getIdKhachHang() {
        return IdKhachHang;
    }

    public void setIdKhachHang(Integer idKhachHang) {
        IdKhachHang = idKhachHang;
    }

    public Integer getIdVeCu() {
        return IdVeCu;
    }

    public void setIdVeCu(Integer idVeCu) {
        IdVeCu = idVeCu;
    }

    public Integer getIdVeMoi() {
        return IdVeMoi;
    }

    public void setIdVeMoi(Integer idVeMoi) {
        IdVeMoi = idVeMoi;
    }

    public BigDecimal getSoTienHoan() {
        return SoTienHoan;
    }

    public void setSoTienHoan(BigDecimal soTienHoan) {
        SoTienHoan = soTienHoan;
    }

    public Integer getIdSuKien() {
        return IdSuKien;
    }

    public void setIdSuKien(Integer idSuKien) {
        IdSuKien = idSuKien;
    }

    public Integer getIdDoiTac() {
        return IdDoiTac;
    }

    public void setIdDoiTac(Integer idDoiTac) {
        IdDoiTac = idDoiTac;
    }
}
