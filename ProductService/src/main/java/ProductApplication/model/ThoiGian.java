package ProductApplication.model;

import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.data.mongodb.core.mapping.Document;
import org.springframework.data.mongodb.core.mapping.Field;

@SpringBootApplication
@Document(collection = "VeDaMua")
public class ThoiGian {
    
	
	@Field("ThoiDiemBatDau")
	private String ThoiDiemBatDau;
	@Field("ThoiDiemKetThuc")
    private String ThoiDiemKetThuc;
	
	public ThoiGian() {
		super();
		// TODO Auto-generated constructor stub
	}
	public ThoiGian(String thoiDiemBatDau, String thoiDiemKetThuc) {
		super();
		ThoiDiemBatDau = thoiDiemBatDau;
		ThoiDiemKetThuc = thoiDiemKetThuc;
	}
	@Override
	public String toString() {
		return "ThoiGian [ThoiDiemBatDau=" + ThoiDiemBatDau + ", ThoiDiemKetThuc=" + ThoiDiemKetThuc + "]";
	}
	public String getThoiDiemBatDau() {
		return ThoiDiemBatDau;
	}
	public void setThoiDiemBatDau(String thoiDiemBatDau) {
		ThoiDiemBatDau = thoiDiemBatDau;
	}
	public String getThoiDiemKetThuc() {
		return ThoiDiemKetThuc;
	}
	public void setThoiDiemKetThuc(String thoiDiemKetThuc) {
		ThoiDiemKetThuc = thoiDiemKetThuc;
	}
 
	
}
