package ProductApplication.DTO;

import java.math.BigDecimal;


public class DanhSachVeDaMuaDTO {
    
	private Integer iDVe;
	private Integer iDSuKien;
	private String tenSuKien;
	private Integer iDLoaiVe;
	private Integer iDDoiTac;
	private String loaiVe;
	private BigDecimal giaBan;
	private ThoiGianDTO thoiGian;
	private DiaDiemDTO diaDiem;
	
	

	

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



	public BigDecimal getGiaBan() {
		return giaBan;
	}

	public void setGiaBan(BigDecimal giaBan) {
		this.giaBan = giaBan;
	}

	public ThoiGianDTO getThoiGian() {
		return thoiGian;
	}

	public void setThoiGian(ThoiGianDTO thoiGian) {
		this.thoiGian = thoiGian;
	}

	public DiaDiemDTO getDiaDiem() {
		return diaDiem;
	}

	public void setDiaDiem(DiaDiemDTO diaDiem) {
		this.diaDiem = diaDiem;
	}

	@Override
	public String toString() {
		return "DanhSachVeDaMuaDTO [iDVe=" + iDVe + ", iDSuKien=" + iDSuKien + ", tenSuKien=" + tenSuKien
				+ ", iDLoaiVe=" + iDLoaiVe + ", iDDoiTac=" + iDDoiTac + ", loaiVe=" + loaiVe + ", giaBan=" + giaBan
				+ ", thoiGian=" + thoiGian + ", diaDiem=" + diaDiem + "]";
	}

	public Integer getiDLoaiVe() {
		return iDLoaiVe;
	}

	public void setiDLoaiVe(Integer iDLoaiVe) {
		this.iDLoaiVe = iDLoaiVe;
	}

	public Integer getiDDoiTac() {
		return iDDoiTac;
	}

	public void setiDDoiTac(Integer iDDoiTac) {
		this.iDDoiTac = iDDoiTac;
	}

	
}
