package com.example.purchase_service.api.dto;

import java.math.BigDecimal;
import java.util.List;

public class goiAPIThanhToanDto {
    private int orderId;
    private String orderinfo;
    private BigDecimal amount;
    private String makhuyenmai;
    private int IDTaiKhoan;
    private List<veDto> DanhSachVe;

    public int getOrderId() {
        return orderId;
    }

    public void setOrderId(int orderId) {
        this.orderId = orderId;
    }

    public String getOrderinfo() {
        return orderinfo;
    }

    public void setOrderinfo(String orderinfo) {
        this.orderinfo = orderinfo;
    }

    public BigDecimal getAmount() {
        return amount;
    }

    public void setAmount(BigDecimal amount) {
        this.amount = amount;
    }

    public String getMakhuyenmai() {
        return makhuyenmai;
    }

    public void setMakhuyenmai(String makhuyenmai) {
        this.makhuyenmai = makhuyenmai;
    }

    public int getIDTaiKhoan() {
        return IDTaiKhoan;
    }

    public void setIDTaiKhoan(int iDTaiKhoan) {
        IDTaiKhoan = iDTaiKhoan;
    }

    public List<veDto> getDanhSachVe() {
        return DanhSachVe;
    }

    public void setDanhSachVe(List<veDto> danhSachVe) {
        DanhSachVe = danhSachVe;
    }
}
