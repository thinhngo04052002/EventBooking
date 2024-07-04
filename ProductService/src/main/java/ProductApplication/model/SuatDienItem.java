package ProductApplication.model;

import java.util.List;

import org.springframework.data.mongodb.core.mapping.Document;
import org.springframework.data.mongodb.core.mapping.Field;

@Document(collection = "SuatDien")
public class SuatDienItem {
	
	@Field("SoThuTu")
	private Integer soThuTu;
	@Field("ThoiGianBatDau")
	private String thoiGianBatDau;
	@Field("ThoiGianKetThuc")
	private String thoiGianKetThuc;
	@Field("Agenda")
	private List<Agenda> agenda;
	@Field("LoaiVe")
	private List<LoaiVe> loaiVe;
	@Field("NguoiThamGia")
	private List<String> nguoiThamGia;
	@Field("NhanSu")
	private List<NhanSu> nhanSu;
	
	public SuatDienItem() {
		super();
		// TODO Auto-generated constructor stub
	}

	public SuatDienItem(Integer soThuTu, String thoiGianBatDau, String thoiGianKetThuc, List<Agenda> agenda,
			List<LoaiVe> loaiVe, List<String> nguoiThamGia, List<NhanSu> nhanSu) {
		super();
		this.soThuTu = soThuTu;
		this.thoiGianBatDau = thoiGianBatDau;
		this.thoiGianKetThuc = thoiGianKetThuc;
		this.agenda = agenda;
		this.loaiVe = loaiVe;
		this.nguoiThamGia = nguoiThamGia;
		this.nhanSu = nhanSu;
	}

	@Override
	public String toString() {
		return "SuatDienItem [soThuTu=" + soThuTu + ", thoiGianBatDau=" + thoiGianBatDau + ", thoiGianKetThuc="
				+ thoiGianKetThuc + ", agenda=" + agenda + ", loaiVe=" + loaiVe + ", nguoiThamGia=" + nguoiThamGia
				+ ", nhanSu=" + nhanSu + "]";
	}

	public Integer getSoThuTu() {
		return soThuTu;
	}

	public void setSoThuTu(Integer soThuTu) {
		this.soThuTu = soThuTu;
	}

	public String getThoiGianBatDau() {
		return thoiGianBatDau;
	}

	public void setThoiGianBatDau(String thoiGianBatDau) {
		this.thoiGianBatDau = thoiGianBatDau;
	}

	public String getThoiGianKetThuc() {
		return thoiGianKetThuc;
	}

	public void setThoiGianKetThuc(String thoiGianKetThuc) {
		this.thoiGianKetThuc = thoiGianKetThuc;
	}

	public List<Agenda> getAgenda() {
		return agenda;
	}

	public void setAgenda(List<Agenda> agenda) {
		this.agenda = agenda;
	}

	public List<LoaiVe> getLoaiVe() {
		return loaiVe;
	}

	public void setLoaiVe(List<LoaiVe> loaiVe) {
		this.loaiVe = loaiVe;
	}

	public List<String> getNguoiThamGia() {
		return nguoiThamGia;
	}

	public void setNguoiThamGia(List<String> nguoiThamGia) {
		this.nguoiThamGia = nguoiThamGia;
	}

	public List<NhanSu> getNhanSu() {
		return nhanSu;
	}

	public void setNhanSu(List<NhanSu> nhanSu) {
		this.nhanSu = nhanSu;
	}

}
