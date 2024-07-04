package ProductApplication.model;

import org.springframework.data.mongodb.core.mapping.Document;
import org.springframework.data.mongodb.core.mapping.Field;

@Document(collection = "VeDaMua")
public class Agenda {

	@Field("ThoiGian")
	private String thoiGian;
	@Field("HoatDong")
	private String hoatDong;
	
	
	public Agenda() {
		super();
		// TODO Auto-generated constructor stub
	}
	public String getThoiGian() {
		return thoiGian;
	}


	public void setThoiGian(String thoiGian) {
		this.thoiGian = thoiGian;
	}




	public String getHoatDong() {
		return hoatDong;
	}




	public void setHoatDong(String hoatDong) {
		this.hoatDong = hoatDong;
	}




	public Agenda(String thoiGian, String hoatDong) {
		super();
		this.thoiGian = thoiGian;
		this.hoatDong = hoatDong;
	}




	@Override
	public String toString() {
		return "Agenda [thoiGian=" + thoiGian + ", hoatDong=" + hoatDong + "]";
	}


	
}
