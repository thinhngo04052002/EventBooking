package ProductApplication.DTO;



public class VeDTO {
    private Integer idve;
    private Integer idloaiVe;
    private Integer idSuatDien;
    private Integer idDoiTac;
    private String trangThaiBan;
    private String soSeri;
    private String trangThaiDung;
    private Integer idsuKien;

	public Integer getIdve() {
		return idve;
	}

	public void setIdve(Integer idve) {
		this.idve = idve;
	}

	public Integer getIdloaiVe() {
		return idloaiVe;
	}

	public void setIdloaiVe(Integer idloaiVe) {
		this.idloaiVe = idloaiVe;
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

	public Integer getIdsuKien() {
		return idsuKien;
	}

	public void setIdsuKien(Integer idsuKien) {
		this.idsuKien = idsuKien;
	}

	
	public Integer getIdSuatDien() {
		return idSuatDien;
	}

	public void setIdSuatDien(Integer idSuatDien) {
		this.idSuatDien = idSuatDien;
	}

	public Integer getIdDoiTac() {
		return idDoiTac;
	}

	public void setIdDoiTac(Integer idDoiTac) {
		this.idDoiTac = idDoiTac;
	}

	@Override
	public String toString() {
		return "VeDTO [idve=" + idve + ", idloaiVe=" + idloaiVe + ", idSuatDien=" + idSuatDien + ", idDoiTac="
				+ idDoiTac + ", trangThaiBan=" + trangThaiBan + ", soSeri=" + soSeri + ", trangThaiDung="
				+ trangThaiDung + ", idsuKien=" + idsuKien + "]";
	}

	
}
