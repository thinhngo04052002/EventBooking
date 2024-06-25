package com.example.purchase_service.api.model;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;

@Entity
public class khuyenmai {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer id;

    private Integer idsukien;

    private Integer iddoitac;

    private Integer chietkhau;

    private String makhuyenmai;

    public khuyenmai() {
    }

    public khuyenmai(Integer id, Integer idsukien, Integer iddoitac, Integer chietkhau, String makhuyenmai) {
        this.id = id;
        this.idsukien = idsukien;
        this.iddoitac = iddoitac;
        this.chietkhau = chietkhau;
        this.makhuyenmai = makhuyenmai;
    }

    public Integer getId() {
        return this.id;
    }

    public Integer getIdsukien() {
        return this.idsukien;
    }

    public Integer getChietkhau() {
        return this.chietkhau;
    }

    public String getMakhuyenmai() {
        return this.makhuyenmai;
    }

    public void setId(Integer id) {
        this.id = id;
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
