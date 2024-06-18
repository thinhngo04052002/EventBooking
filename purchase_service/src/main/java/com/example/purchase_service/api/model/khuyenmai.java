package com.example.purchase_service.api.model;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;

@Entity
public class khuyenmai {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int id;

    private int idsukien;

    private int chietkhau;

    private String makhuyenmai;

    public khuyenmai() {
    }

    public khuyenmai(int id, int idsukien, int chietkhau, String makhuyenmai) {
        this.id = id;
        this.idsukien = idsukien;
        this.chietkhau = chietkhau;
        this.makhuyenmai = makhuyenmai;
    }

    public int getId() {
        return this.id;
    }

    public int getIdsukien() {
        return this.idsukien;
    }

    public int getChietkhau() {
        return this.chietkhau;
    }

    public String getMakhuyenmai() {
        return this.makhuyenmai;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setIdsukien(int idsukien) {
        this.idsukien = idsukien;
    }

    public void setChietkhau(int chietkhau) {
        this.chietkhau = chietkhau;
    }

    public void setMakhuyenmai(String makhuyenmai) {
        this.makhuyenmai = makhuyenmai;
    }

}
