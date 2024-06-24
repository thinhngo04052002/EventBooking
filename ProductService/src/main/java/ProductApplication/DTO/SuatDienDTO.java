package ProductApplication.DTO;

import java.util.List;



public class SuatDienDTO {
    
    private Integer IDSuKien;
    private Integer IDDoiTac;
	private List<SuatDienItemDTO> SuatDienItemDTO;
	
	public SuatDienDTO() {
		super();
		// TODO Auto-generated constructor stub
	}



	@Override
	public String toString() {
		return "SuatDienDTO [IDSuKien=" + IDSuKien + ", IDDoiTac=" + IDDoiTac + ", SuatDienItemDTO=" + SuatDienItemDTO
				+ "]";
	}



	public Integer getIDSuKien() {
		return IDSuKien;
	}



	public void setIDSuKien(Integer iDSuKien) {
		IDSuKien = iDSuKien;
	}





	public Integer getIDDoiTac() {
		return IDDoiTac;
	}



	public void setIDDoiTac(Integer iDDoiTac) {
		IDDoiTac = iDDoiTac;
	}



	public SuatDienDTO(Integer iDSuKien, List<ProductApplication.DTO.SuatDienItemDTO> suatDienItemDTO) {
		super();
		IDSuKien = iDSuKien;
		SuatDienItemDTO = suatDienItemDTO;
	}



	public List<SuatDienItemDTO> getSuatDienItemDTO() {
		return SuatDienItemDTO;
	}

	public void setSuatDienItemDTO(List<SuatDienItemDTO> suatDienItemDTO) {
		SuatDienItemDTO = suatDienItemDTO;
	}

    
	
}
