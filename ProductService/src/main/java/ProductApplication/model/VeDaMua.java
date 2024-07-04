package ProductApplication.model;

import java.util.List;

import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.data.annotation.Id;
import org.springframework.data.mongodb.core.mapping.Document;
import org.springframework.data.mongodb.core.mapping.Field;

@SpringBootApplication
@Document(collection = "VeDaMua")
public class VeDaMua {
    
	@Id
	private String _id;
	@Field("IDNguoiDung")
    private Integer IDNguoiDung;
	@Field("DanhSachVe")
	private List<DanhSachVeDaMua> DanhSachVeDaMua;
	
	public VeDaMua() {
		super();
		// TODO Auto-generated constructor stub
	}

	public VeDaMua(String _id, Integer iDNguoiDung, List<ProductApplication.model.DanhSachVeDaMua> danhSachVeDaMua) {
		super();
		this._id = _id;
		IDNguoiDung = iDNguoiDung;
		DanhSachVeDaMua = danhSachVeDaMua;
	}

	@Override
	public String toString() {
		return "VeDaMua [_id=" + _id + ", IDNguoiDung=" + IDNguoiDung + ", DanhSachVeDaMua=" + DanhSachVeDaMua + "]";
	}

	public String get_id() {
		return _id;
	}

	public void set_id(String _id) {
		this._id = _id;
	}

	public Integer getIDNguoiDung() {
		return IDNguoiDung;
	}

	public void setIDNguoiDung(Integer iDNguoiDung) {
		IDNguoiDung = iDNguoiDung;
	}

	public List<DanhSachVeDaMua> getDanhSachVeDaMua() {
		return DanhSachVeDaMua;
	}

	public void setDanhSachVeDaMua(List<DanhSachVeDaMua> danhSachVeDaMua) {
		DanhSachVeDaMua = danhSachVeDaMua;
	}
	
	
}
