package ProductApplication.model;

import org.springframework.boot.autoconfigure.SpringBootApplication;
//import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.data.annotation.Id;
import org.springframework.data.mongodb.core.mapping.Document;
import org.springframework.data.mongodb.core.mapping.Field;


@SpringBootApplication
@Document(collection = "Ve")

public class Ve {
    @Id
    private String _id;
    @Field("IDVe")
    private Integer iDVe;

    @Field("IDLoaiVe")
    private Integer iDLoaiVe;
    
    @Field("IDSuatDien")
    private Integer iDSuatDien;
    
    @Field("IDDoiTac")
    private Integer iDDoiTac;
    
    @Field("TrangThaiBan")
    private String trangThaiBan;

    @Field("SoSeri")
    private String soSeri;

    @Field("TrangThaiDung")
    private String trangThaiDung;

    @Field("IDSuKien")
    private Integer iDSuKien;
    
    public Ve() {
        super();
    }
    public String get_id() {
		return _id;
	}
	public void set_id(String _id) {
		this._id = _id;
	}

	public Integer getiDLoaiVe() {
		return iDLoaiVe;
	}
	public void setiDLoaiVe(Integer iDLoaiVe) {
		this.iDLoaiVe = iDLoaiVe;
	}
	public String getTrangThaiBan() {
		return trangThaiBan;
	}
	public void setTrangThaiBan(String trangThaiBan) {
		this.trangThaiBan = trangThaiBan;
	}
	public String getSoSeri() {
		return soSeri;
	}
	public void setSoSeri(String soSeri) {
		this.soSeri = soSeri;
	}
	public String getTrangThaiDung() {
		return trangThaiDung;
	}
	public void setTrangThaiDung(String trangThaiDung) {
		this.trangThaiDung = trangThaiDung;
	}
	public Integer getiDSuKien() {
		return iDSuKien;
	}
	public void setiDSuKien(Integer iDSuKien) {
		this.iDSuKien = iDSuKien;
	}
	public Integer getiDVe() {
		return iDVe;
	}
	public void setiDVe(Integer iDVe) {
		this.iDVe = iDVe;
	}
	public Integer getiDSuatDien() {
		return iDSuatDien;
	}
	public void setiDSuatDien(Integer iDSuatDien) {
		this.iDSuatDien = iDSuatDien;
	}
	public Integer getiDDoiTac() {
		return iDDoiTac;
	}
	public void setiDDoiTac(Integer iDDoiTac) {
		this.iDDoiTac = iDDoiTac;
	}
	public Ve(String _id, Integer iDVe, Integer iDLoaiVe, Integer iDSuatDien, Integer iDDoiTac, String trangThaiBan,
			String soSeri, String trangThaiDung, Integer iDSuKien) {
		super();
		this._id = _id;
		this.iDVe = iDVe;
		this.iDLoaiVe = iDLoaiVe;
		this.iDSuatDien = iDSuatDien;
		this.iDDoiTac = iDDoiTac;
		this.trangThaiBan = trangThaiBan;
		this.soSeri = soSeri;
		this.trangThaiDung = trangThaiDung;
		this.iDSuKien = iDSuKien;
	}
	@Override
	public String toString() {
		return "Ve [_id=" + _id + ", iDVe=" + iDVe + ", iDLoaiVe=" + iDLoaiVe + ", iDSuatDien=" + iDSuatDien
				+ ", iDDoiTac=" + iDDoiTac + ", trangThaiBan=" + trangThaiBan + ", soSeri=" + soSeri
				+ ", trangThaiDung=" + trangThaiDung + ", iDSuKien=" + iDSuKien + "]";
	}
	
}
