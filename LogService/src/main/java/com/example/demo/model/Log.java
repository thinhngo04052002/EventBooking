package com.example.demo.model;

import java.time.Instant;
import org.springframework.data.annotation.Id;
import org.springframework.data.mongodb.core.mapping.Document;

@Document(collection = "Log")
public class Log {
    @Id
    private String _id;
    private String TenHanhDong;
    private Instant ThoiGian;
    private String MoTa;
    private String DiaChiIPThietBi;

    public Log() {
        super();
    }

    public Log(String _id, String tenHanhDong, Instant thoiGian, String moTa, String diaChiIPThietBi) {
        super();
        this._id = _id;
        TenHanhDong = tenHanhDong;
        ThoiGian = thoiGian;
        MoTa = moTa;
        DiaChiIPThietBi = diaChiIPThietBi;
    }

    public String get_id() {
        return this._id;
    }

    public String getTenHanhDong() {
        return this.TenHanhDong;
    }

    public Instant getThoiGian() {
        return this.ThoiGian;
    }

    public String getMoTa() {
        return this.MoTa;
    }

    public String getDiaChiIPThietBi() {
        return this.DiaChiIPThietBi;
    }

    public void set_id(String _id) {
        this._id = _id;
    }

    public void setTenHanhDong(String tenHanhDong) {
        this.TenHanhDong = tenHanhDong;
    }

    public void setThoiGian(Instant thoiGian) {
        this.ThoiGian = thoiGian;
    }

    public void setMoTa(String moTa) {
        this.MoTa = moTa;
    }

    public void setDiaChiIPThietBi(String diaChiIPThietBi) {
        this.DiaChiIPThietBi = diaChiIPThietBi;
    }

    @Override
    public String toString() {
        return "{" +
                "\"_id\":\"" + _id + "\"," +
                "\"TenHanhDong\":\"" + TenHanhDong + "\"," +
                "\"ThoiGian\":\"" + ThoiGian + "\"," +
                "\"MoTa\":\"" + MoTa + "\"," +
                "\"DiaChiIPThietBi\":\"" + DiaChiIPThietBi + "\"" +
                '}';
    }
}
