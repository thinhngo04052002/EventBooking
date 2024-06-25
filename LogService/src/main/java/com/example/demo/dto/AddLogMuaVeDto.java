package com.example.demo.dto;

import java.math.BigDecimal;
import java.util.List;

public class AddLogMuaVeDto {
    private Integer IdKhachHang;
    private List<Integer> DanhSachVe;
    private Integer IdSuKien;
    private Integer IdDoiTac;
    private BigDecimal TongTien;

    public BigDecimal getTongTien() {
        return TongTien;
    }

    public void setTongTien(BigDecimal tongTien) {
        TongTien = tongTien;
    }

    public Integer getIdKhachHang() {
        return IdKhachHang;
    }

    public void setIdKhachHang(Integer idKhachHang) {
        IdKhachHang = idKhachHang;
    }

    public List<Integer> getDanhSachVe() {
        return this.DanhSachVe;
    }

    public void setDanhSachVe(List<Integer> danhSachVe) {
        DanhSachVe = danhSachVe;
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