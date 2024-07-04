package ProductApplication.model;

import java.math.BigDecimal;

import org.springframework.data.mongodb.core.mapping.Document;
import org.springframework.data.mongodb.core.mapping.Field;

@Document(collection = "VeDaMua")
public class LoaiVe {
    
	
	@Field("IDLoaiVe")
	private Integer iDLoaiVe;
	@Field("TenLoaiVe")
	private String tenLoaiVe;
	@Field("MoTa")
	private String moTa;
	@Field("GiaVe")
	private BigDecimal giaVe;
	@Field("SoLuong")
	private Integer soLuong;
	@Field("SoVeToiDaTrongMotDonHang")
	private Integer soVeToiDaTrongMotDonHang;
	@Field("ThoiGianBatDauBanVe")
	private String thoiGianBatDauBanVe;
	@Field("ThoiGianKetThucBanVe")
	private String thoiGianKetThucBanVe;
	
	public LoaiVe() {
		super();
		// TODO Auto-generated constructor stub
	}

	public LoaiVe(Integer iDLoaiVe, String tenLoaiVe, String moTa, BigDecimal giaVe, Integer soLuong,
			Integer soVeToiDaTrongMotDonHang, String thoiGianBatDauBanVe, String thoiGianKetThucBanVe) {
		super();
		this.iDLoaiVe = iDLoaiVe;
		this.tenLoaiVe = tenLoaiVe;
		this.moTa = moTa;
		this.giaVe = giaVe;
		this.soLuong = soLuong;
		this.soVeToiDaTrongMotDonHang = soVeToiDaTrongMotDonHang;
		this.thoiGianBatDauBanVe = thoiGianBatDauBanVe;
		this.thoiGianKetThucBanVe = thoiGianKetThucBanVe;
	}

	@Override
	public String toString() {
		return "LoaiVe [iDLoaiVe=" + iDLoaiVe + ", tenLoaiVe=" + tenLoaiVe + ", moTa=" + moTa + ", giaVe=" + giaVe
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
