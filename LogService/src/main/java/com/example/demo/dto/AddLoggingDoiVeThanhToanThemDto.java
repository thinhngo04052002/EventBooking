package com.example.demo.dto;

import java.math.BigDecimal;

public class AddLoggingDoiVeThanhToanThemDto {
    private Integer IdVeCu;
    private Integer IdVeMoi;
    private BigDecimal SoTienThanhToanThem;
    private Integer IdKhachHang;

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

    public BigDecimal getSoTienThanhToanThem() {
        return SoTienThanhToanThem;
    }

    public void setSoTienThanhToanThem(BigDecimal soTienThanhToanThem) {
        SoTienThanhToanThem = soTienThanhToanThem;
    }

    public Integer getIdKhachHang() {
        return IdKhachHang;
    }

    public void setIdKhachHang(Integer idKhachHang) {
        IdKhachHang = idKhachHang;
    }
}
