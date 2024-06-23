package ProductApplication.model;

import java.math.BigDecimal;

import org.springframework.data.mongodb.core.mapping.Document;
import org.springframework.data.mongodb.core.mapping.Field;

@Document(collection = "VeDaMua")
public class DanhSachVeDaMua {
    
	
	@Field("IDVe")
	private Integer iDVe;
	@Field("IDSuKien")
	private Integer iDSuKien;
	@Field("TenSuKien")
	private String tenSuKien;
	@Field("IDLoaiVe")
	private Integer iDLoaiVe;
	@Field("IDDoiTac")
	private Integer iDDoiTac;
	@Field("LoaiVe")
	private String loaiVe;
	@Field("GiaBan")
	private BigDecimal giaBan;
	@Field("ThoiGian")
	private ThoiGian thoiGian;
	@Field("DiaDiem")
	private DiaDiem diaDiem;
	
	public DanhSachVeDaMua() {
		super();
		// TODO Auto-generated constructor stub
	}
	
	public Integer getiDLoaiVe() {
		return iDLoaiVe;
	}

	public void setiDLoaiVe(Integer iDLoaiVe) {
		this.iDLoaiVe = iDLoaiVe;
	}

	
	

	public Integer getiDVe() {
		return iDVe;
	}
	public void setiDVe(Integer iDVe) {
		this.iDVe = iDVe;
	}
	public Integer getiDSuKien() {
		return iDSuKien;
	}
	public void setiDSuKien(Integer iDSuKien) {
		this.iDSuKien = iDSuKien;
	}
	
	public String getTenSuKien() {
		return tenSuKien;
	}

	public void setTenSuKien(String tenSuKien) {
		this.tenSuKien = tenSuKien;
	}

	public String getLoaiVe() {
		return loaiVe;
	}
	public void setLoaiVe(String loaiVe) {
		this.loaiVe = loaiVe;
	}
	
	public ThoiGian getThoiGian() {
		return thoiGian;
	}
	public void setThoiGian(ThoiGian thoiGian) {
		this.thoiGian = thoiGian;
	}
	
	public DiaDiem getDiaDiem() {
		return diaDiem;
	}
	public void setDiaDiem(DiaDiem diaDiem) {
		this.diaDiem = diaDiem;
	}

	

	public Integer getiDDoiTac() {
		return iDDoiTac;
	}

	public void setiDDoiTac(Integer iDDoiTac) {
		this.iDDoiTac = iDDoiTac;
	}

	@Override
	public String toString() {
		return "DanhSachVeDaMua [iDVe=" + iDVe + ", iDSuKien=" + iDSuKien + ", tenSuKien=" + tenSuKien + ", iDLoaiVe="
				+ iDLoaiVe + ", iDDoiTac=" + iDDoiTac + ", loaiVe=" + loaiVe + ", giaBan=" + giaBan + ", thoiGian="
				+ thoiGian + ", diaDiem=" + diaDiem + "]";
	}

	public DanhSachVeDaMua(Integer iDVe, Integer iDSuKien, String tenSuKien, Integer iDLoaiVe, Integer iDDoiTac,
			String loaiVe, BigDecimal giaBan, ThoiGian thoiGian, DiaDiem diaDiem) {
		super();
		this.iDVe = iDVe;
		this.iDSuKien = iDSuKien;
		this.tenSuKien = tenSuKien;
		this.iDLoaiVe = iDLoaiVe;
		this.iDDoiTac = iDDoiTac;
		this.loaiVe = loaiVe;
		this.giaBan = giaBan;
		this.thoiGian = thoiGian;
		this.diaDiem = diaDiem;
	}

	public BigDecimal getGiaBan() {
		return giaBan;
	}

	public void setGiaBan(BigDecimal giaBan) {
		this.giaBan = giaBan;
	}
        
    
}
