package com.example.purchase_service.api.dto;

public class addKhuyenmaiDto {
    private Integer idsukien;

    private Integer iddoitac;

    private Integer chietkhau;

    private String makhuyenmai;

    public Integer getIdsukien() {
        return this.idsukien;
    }

    public Integer getChietkhau() {
        return this.chietkhau;
    }

    public String getMakhuyenmai() {
        return this.makhuyenmai;
    }

    public void setIdsukien(Integer idsukien) {
        this.idsukien = idsukien;
    }

    public void setChietkhau(Integer chietkhau) {
        this.chietkhau = chietkhau;
    }

    public void setMakhuyenmai(String makhuyenmai) {
        this.makhuyenmai = makhuyenmai;
    }

    public Integer getIddoitac() {
        return iddoitac;
    }

    public void setIddoitac(Integer iddoitac) {
        this.iddoitac = iddoitac;
    }

}
