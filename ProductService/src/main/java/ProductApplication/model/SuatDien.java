package ProductApplication.model;

import java.util.List;

import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.data.annotation.Id;
import org.springframework.data.mongodb.core.mapping.Document;
import org.springframework.data.mongodb.core.mapping.Field;

@SpringBootApplication
@Document(collection = "SuatDien")
public class SuatDien {
    
	@Id
	private String _id;
	@Field("IDSuKien")
    private Integer IDSuKien;
	@Field("IDDoiTac")
    private Integer IDDoiTac;
	@Field("SuatDien")
	private List<SuatDienItem> SuatDienItem;
	
	public SuatDien() {
		super();
		// TODO Auto-generated constructor stub
	}

	

	@Override
	public String toString() {
		return "SuatDien [_id=" + _id + ", IDSuKien=" + IDSuKien + ", IDDoiTac=" + IDDoiTac + ", SuatDienItem="
				+ SuatDienItem + "]";
	}



	public SuatDien(String _id, Integer iDSuKien, Integer iDDoiTac,
			List<ProductApplication.model.SuatDienItem> suatDienItem) {
		super();
		this._id = _id;
		IDSuKien = iDSuKien;
		IDDoiTac = iDDoiTac;
		SuatDienItem = suatDienItem;
	}



	public Integer getIDDoiTac() {
		return IDDoiTac;
	}



	public void setIDDoiTac(Integer iDDoiTac) {
		IDDoiTac = iDDoiTac;
	}



	public String get_id() {
		return _id;
	}

	public void set_id(String _id) {
		this._id = _id;
	}

	public Integer getIDSuKien() {
		return IDSuKien;
	}

	public void setIDSuKien(Integer iDSuKien) {
		IDSuKien = iDSuKien;
	}

	public List<SuatDienItem> getSuatDienItem() {
		return SuatDienItem;
	}

	public void setSuatDienItem(List<SuatDienItem> suatDienItem) {
		SuatDienItem = suatDienItem;
	}

	
    
	
}
