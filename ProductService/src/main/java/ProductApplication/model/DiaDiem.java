package ProductApplication.model;

import org.springframework.data.mongodb.core.mapping.Document;
import org.springframework.data.mongodb.core.mapping.Field;
@Document(collection = "SuKien")
public class DiaDiem {
	@Field("QuocGia")
	private String QuocGia;
	@Field("ThanhPho")
	private String ThanhPho;
	@Field("NoiToChuc")
	private String NoiToChuc;
	
	public DiaDiem() {
		super();
		// TODO Auto-generated constructor stub
	}
	public DiaDiem(String quocGia, String thanhPho, String noiToChuc) {
		super();
		QuocGia = quocGia;
		ThanhPho = thanhPho;
		NoiToChuc = noiToChuc;
	}

	@Override
	public String toString() {
		return "DiaDiem [QuocGia=" + QuocGia + ", ThanhPho=" + ThanhPho + ", NoiToChuc=" + NoiToChuc + "]";
	}
	public String getQuocGia() {
		return QuocGia;
	}
	public void setQuocGia(String quocGia) {
		QuocGia = quocGia;
	}
	public String getThanhPho() {
		return ThanhPho;
	}
	public void setThanhPho(String thanhPho) {
		ThanhPho = thanhPho;
	}
	public String getNoiToChuc() {
		return NoiToChuc;
	}
	public void setNoiToChuc(String noiToChuc) {
		NoiToChuc = noiToChuc;
	}

    
	// Getters, setters, constructors
	
}