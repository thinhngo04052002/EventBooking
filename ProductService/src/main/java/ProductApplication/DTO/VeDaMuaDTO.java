package ProductApplication.DTO;

import java.util.List;

public class VeDaMuaDTO {
    
    private Integer IDNguoiDung;
    private List<DanhSachVeDaMuaDTO> DanhSachVeDaMua;
    
	@Override
	public String toString() {
		return "VeDaMuaDTO [IDNguoiDung=" + IDNguoiDung + ", DanhSachVeDaMua=" + DanhSachVeDaMua + "]";
	}

	public Integer getIDNguoiDung() {
		return IDNguoiDung;
	}

	public void setIDNguoiDung(Integer iDNguoiDung) {
		IDNguoiDung = iDNguoiDung;
	}

	public List<DanhSachVeDaMuaDTO> getDanhSachVeDaMua() {
		return DanhSachVeDaMua;
	}

	public void setDanhSachVeDaMua(List<DanhSachVeDaMuaDTO> danhSachVeDaMua) {
		DanhSachVeDaMua = danhSachVeDaMua;
	}
	
	
    
}
