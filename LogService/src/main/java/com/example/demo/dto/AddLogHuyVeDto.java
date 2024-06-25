package com.example.demo.dto;

import java.math.BigDecimal;

public class AddLogHuyVeDto {
    private Integer IdVe;
    private Integer IdSuKien;
    private Integer IdDoiTac;
    private BigDecimal SoTienHoan;
    private Integer IdKhachHang;

    public Integer getIdVe() {
        return IdVe;
    }

    public void setIdVe(Integer idVe) {
        IdVe = idVe;
    }

    public BigDecimal getSoTienHoan() {
        return SoTienHoan;
    }

    public void setSoTienHoan(BigDecimal soTienHoan) {
        SoTienHoan = soTienHoan;
    }

    public Integer getIdKhachHang() {
        return IdKhachHang;
    }

    public void setIdKhachHang(Integer idKhachHang) {
        IdKhachHang = idKhachHang;
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
