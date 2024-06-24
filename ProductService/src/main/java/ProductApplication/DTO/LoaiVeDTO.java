package ProductApplication.DTO;

import java.math.BigDecimal;

public class LoaiVeDTO {
    

	private Integer iDLoaiVe;
	private String tenLoaiVe;
	private String moTa;
	private BigDecimal giaVe;
	private Integer soLuong;
	private Integer soVeToiDaTrongMotDonHang;
	private String thoiGianBatDauBanVe;
	private String thoiGianKetThucBanVe;
	
	@Override
	public String toString() {
		return "LoaiVeDTO [iDLoaiVe=" + iDLoaiVe + ", tenLoaiVe=" + tenLoaiVe + ", moTa=" + moTa + ", giaVe=" + giaVe
				+ ", soLuong=" + soLuong + ", soVeToiDaTrongMotDonHang=" + soVeToiDaTrongMotDonHang
				+ ", thoiGianBatDauBanVe=" + thoiGianBatDauBanVe + ", thoiGianKetThucBanVe=" + thoiGianKetThucBanVe
				+ "]";
	}

	public Integer getiDLoaiVe() {
		return iDLoaiVe;
	}

	public void setiDLoaiVe(Integer iDLoaiVe) {
		this.iDLoaiVe = iDLoaiVe;
	}

	public String getTenLoaiVe() {
		return tenLoaiVe;
	}

	public void setTenLoaiVe(String tenLoaiVe) {
		this.tenLoaiVe = tenLoaiVe;
	}

	public String getMoTa() {
		return moTa;
	}

	public void setMoTa(String moTa) {
		this.moTa = moTa;
	}

	public BigDecimal getGiaVe() {
		return giaVe;
	}

	public void setGiaVe(BigDecimal giaVe) {
		this.giaVe = giaVe;
	}

	public Integer getSoLuong() {
		return soLuong;
	}

	public void setSoLuong(Integer soLuong) {
		this.soLuong = soLuong;
	}

	public Integer getSoVeToiDaTrongMotDonHang() {
		return soVeToiDaTrongMotDonHang;
	}

	public void setSoVeToiDaTrongMotDonHang(Integer soVeToiDaTrongMotDonHang) {
		this.soVeToiDaTrongMotDonHang = soVeToiDaTrongMotDonHang;
	}

	public String getThoiGianBatDauBanVe() {
		return thoiGianBatDauBanVe;
	}

	public void setThoiGianBatDauBanVe(String thoiGianBatDauBanVe) {
		this.thoiGianBatDauBanVe = thoiGianBatDauBanVe;
	}

	public String getThoiGianKetThucBanVe() {
		return thoiGianKetThucBanVe;
	}

	public void setThoiGianKetThucBanVe(String thoiGianKetThucBanVe) {
		this.thoiGianKetThucBanVe = thoiGianKetThucBanVe;
	}
	
	
	
	
}
