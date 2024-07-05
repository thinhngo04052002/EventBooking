package ProductApplication.service;

import java.util.ArrayList;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import ProductApplication.DTO.SuKienDTO;
import ProductApplication.DTO.UpdateSuKienDTO;
import ProductApplication.DTO.AddSuKienDTO;
import ProductApplication.DTO.DiaDiemDTO;
import ProductApplication.DTO.PostSuKienDTO;
import ProductApplication.model.DiaDiem;
import ProductApplication.model.SuKien;
import ProductApplication.repository.SuKienRepository;
import ProductApplication.repository.SuatDienRepository;

@Service
public class SuKienService {
	@Autowired
    private SuKienRepository suKienRepository;
	@Autowired
    private SuatDienRepository suatDienRepository;

    public Integer createSuKien(PostSuKienDTO suKienDTO) {
    	SuKien sukien = new SuKien();
    	if(suKienDTO.getAnhSoDoGhe()!=null) {
    		sukien.setAnhSoDoGhe(suKienDTO.getAnhSoDoGhe());
    	}
    	sukien.setThongTinSuKien(suKienDTO.getThongTinSuKien());
    	sukien.setAnhNenSuKien(suKienDTO.getAnhNenSuKien());
    	sukien.setDiaChi(suKienDTO.getDiaChi());
    	DiaDiem diaDiem = convertDiaDiemToEntity(suKienDTO.getDiaDiem());
      	sukien.setDiaDiem(diaDiem);
      	sukien.setDuongDan(suKienDTO.getDuongDan());
      	sukien.setLoiCamOn(suKienDTO.getLoiCamOn());
      	sukien.setTheLoai(suKienDTO.getTheLoai());
      	
      	List<SuKien> sukiencuadoitac= suKienRepository.findByIdDoiTac(suKienDTO.getIDDoiTac());
      	int maxIDSuKien = 0;
      	for (SuKien sk : sukiencuadoitac) {
      	    if (sk.getIdSuKien() > maxIDSuKien) {
      	        maxIDSuKien = sk.getIdSuKien();
      	    }
      	}
        sukien.setIdSuKien(maxIDSuKien+1);
        sukien.setIdDoiTac(suKienDTO.getIDDoiTac());
        sukien.setTenSuKien(suKienDTO.getTenSuKien());
        sukien.setThanhToan("Chưa thanh toán");
        try {
        	suKienRepository.save(sukien);
            return 1;
        } catch (Exception e) {
            return 0;
        }
    }
    
    public Integer createSuKien2(AddSuKienDTO suKienDTO) {
    	SuKien sukien = new SuKien();
    	if(suKienDTO.getAnhSoDoGhe()!=null) {
    		sukien.setAnhSoDoGhe(suKienDTO.getAnhSoDoGhe());
    	}
    	sukien.setThongTinSuKien(suKienDTO.getThongTinSuKien());
    	sukien.setAnhNenSuKien(suKienDTO.getAnhNenSuKien());
    	sukien.setDiaChi(suKienDTO.getDiaChi());
    	DiaDiem diaDiem = convertDiaDiemToEntity(suKienDTO.getDiaDiem());
      	sukien.setDiaDiem(diaDiem);
      	sukien.setDuongDan(suKienDTO.getDuongDan());
      	sukien.setLoiCamOn(suKienDTO.getLoiCamOn());
      	sukien.setTheLoai(suKienDTO.getTheLoai());
      	
      	List<SuKien> sukiencuadoitac= suKienRepository.findByIdDoiTac(suKienDTO.getIDDoiTac());
      	int maxIDSuKien = 0;
      	for (SuKien sk : sukiencuadoitac) {
      	    if (sk.getIdSuKien() > maxIDSuKien) {
      	        maxIDSuKien = sk.getIdSuKien();
      	    }
      	}
        sukien.setIdSuKien(maxIDSuKien+1);
        sukien.setIdDoiTac(suKienDTO.getIDDoiTac());
        sukien.setTenSuKien(suKienDTO.getTenSuKien());
        sukien.setThanhToan("Chưa thanh toán");
        try {
        	suKienRepository.save(sukien);
        	
            return 1;
        } catch (Exception e) {
            return 0;
        }
    }

    public SuKienDTO getSuKienByIDSuKienAndIdDoiTac(Integer IDSuKien,Integer IdDoiTac) {
        SuKien suKien = suKienRepository.findByIdSuKienAndIdDoiTac(IDSuKien,IdDoiTac);
        if (suKien!=null) {
            return convertToDTO(suKien);
        }else {
            return null; 
        }
    }
    
    public List<SuKienDTO> getSuKienByTheLoai(String TheLoai) {
    	System.out.println(TheLoai);
    	List<SuKien> suKienList = suKienRepository.findByTheLoaiContaining(TheLoai);
    	System.out.println(suKienList);
        if (suKienList.isEmpty()) {
            return null; 
        }
        List<SuKienDTO> suKienListDTO = new ArrayList<>();
        for (SuKien sukien : suKienList) {
        	suKienListDTO.add(convertToDTO(sukien));
        }
        return suKienListDTO;
    }
    
    public List<SuKienDTO> getSuKienByTenSuKien(String TenSuKien) {
    	System.out.println(TenSuKien);
    	List<SuKien> suKienList = suKienRepository.findByTenSuKien(TenSuKien);
    	System.out.println(suKienList);
        if (suKienList.isEmpty()) {
            return null; 
        }
        List<SuKienDTO> suKienListDTO = new ArrayList<>();
        for (SuKien sukien : suKienList) {
        	suKienListDTO.add(convertToDTO(sukien));
        }
        return suKienListDTO;
    }
    
    public List<SuKienDTO> getSuKienByThanhToan(String ThanhToan) {
    	List<SuKien> suKienList = suKienRepository.findByThanhToan(ThanhToan);
    	System.out.println(suKienRepository.findByThanhToan(ThanhToan));
        if (suKienList.isEmpty()) {
            return null; 
        }
        List<SuKienDTO> suKienListDTO = new ArrayList<>();
        for (SuKien sukien : suKienList) {
        	suKienListDTO.add(convertToDTO(sukien));
        }
        return suKienListDTO;
    }
    
    public List<SuKienDTO> getSuKienByQuocGia(String QuocGia) {
    	List<SuKien> suKienList = suKienRepository.findByQuocGia(QuocGia);
    	System.out.println(suKienRepository.findByQuocGia(QuocGia));
        if (suKienList.isEmpty()) {
            return null; 
        }
        List<SuKienDTO> suKienListDTO = new ArrayList<>();
        for (SuKien sukien : suKienList) {
        	suKienListDTO.add(convertToDTO(sukien));
        }
        return suKienListDTO;
    }
    
    public List<SuKienDTO> getSuKienByThanhPho(String ThanhPho) {
    	List<SuKien> suKienList = suKienRepository.findByThanhPho(ThanhPho);
    	System.out.println(suKienRepository.findByThanhPho(ThanhPho));
        if (suKienList.isEmpty()) {
            return null; 
        }
        List<SuKienDTO> suKienListDTO = new ArrayList<>();
        for (SuKien sukien : suKienList) {
        	suKienListDTO.add(convertToDTO(sukien));
        }
        return suKienListDTO;
    }
    
    public List<SuKienDTO> getSuKienByNoiToChuc(String NoiToChuc) {
    	List<SuKien> suKienList = suKienRepository.findByNoiToChuc(NoiToChuc);
    	System.out.println(suKienRepository.findByNoiToChuc(NoiToChuc));
        if (suKienList.isEmpty()) {
            return null; 
        }
        List<SuKienDTO> suKienListDTO = new ArrayList<>();
        for (SuKien sukien : suKienList) {
        	suKienListDTO.add(convertToDTO(sukien));
        }
        return suKienListDTO;
    }
    
    public List<SuKienDTO> getSuKienByIdDoiTac(Integer IDDoiTac) {
    	List<SuKien> suKienList = suKienRepository.findByIdDoiTac(IDDoiTac);
    	System.out.println(suKienRepository.findByIdDoiTac(IDDoiTac));
        if (suKienList.isEmpty()) {
            return null; 
        }
        List<SuKienDTO> suKienListDTO = new ArrayList<>();
        for (SuKien sukien : suKienList) {
        	suKienListDTO.add(convertToDTO(sukien));
        }
        return suKienListDTO;
    }
    
    public List<SuKienDTO> getSuKienByTenSuKienAndDiaDiem(String TenSuKien,String QuocGia,String ThanhPho,String NoiToChuc){
    	List<SuKien> suKienList = suKienRepository.findByTenSuKienAndDiaDiem(TenSuKien, QuocGia, ThanhPho, NoiToChuc);
        if (suKienList.isEmpty()) {
            return null; 
        }
        List<SuKienDTO> suKienListDTO = new ArrayList<>();
        for (SuKien sukien : suKienList) {
        	suKienListDTO.add(convertToDTO(sukien));
        }
        return suKienListDTO;
    }
    
    public List<SuKienDTO> getAllSuKien() {
        List<SuKien> allSuKien = suKienRepository.findAll();
        if (allSuKien.isEmpty()) {
            return null; 
        }
        List<SuKienDTO> suKienListDTO = new ArrayList<>();
        for (SuKien sukien : allSuKien) {
        	suKienListDTO.add(convertToDTO(sukien));
        }
        return suKienListDTO;
    }

    public Integer updateSuKien(Integer IdSuKien,Integer IdDoiTac,UpdateSuKienDTO updateSuKienDTO) {
        SuKien existingSuKien = suKienRepository.findByIdSuKienAndIdDoiTac(IdSuKien,IdDoiTac);
        if (existingSuKien!=null) {
        	
        	if(updateSuKienDTO.getAnhNenSuKien()!=null) {
        		existingSuKien.setAnhNenSuKien(updateSuKienDTO.getAnhNenSuKien());
        	}
        	if(updateSuKienDTO.getAnhSoDoGhe()!=null) {
        		existingSuKien.setAnhSoDoGhe(updateSuKienDTO.getAnhSoDoGhe());
        	}
        	if(updateSuKienDTO.getDiaChi()!=null) {
        		existingSuKien.setDiaChi(updateSuKienDTO.getDiaChi());
        	}
        	if(updateSuKienDTO.getDuongDan()!=null) {
        		existingSuKien.setDuongDan(updateSuKienDTO.getDuongDan());
        	}
        	if(updateSuKienDTO.getLoiCamOn()!=null) {
        		existingSuKien.setLoiCamOn(updateSuKienDTO.getLoiCamOn());
        	}
        	if(updateSuKienDTO.getThongTinSuKien()!=null) {
        		existingSuKien.setThongTinSuKien(updateSuKienDTO.getThongTinSuKien());
        	}
        	if(updateSuKienDTO.getTheLoai()!=null) {
        		existingSuKien.setTheLoai(updateSuKienDTO.getTheLoai());
        	}
        	if(updateSuKienDTO.getTenSuKien()!=null) {
        		existingSuKien.setTenSuKien(updateSuKienDTO.getTenSuKien());
        	}
        	if(updateSuKienDTO.getDiaDiem()!=null) {
       		 DiaDiem diaDiem = convertDiaDiemToEntity(updateSuKienDTO.getDiaDiem());
       		existingSuKien.setDiaDiem(diaDiem);
       	}
       	 try {
       		suKienRepository.save(existingSuKien);
                return 1;
            } catch (Exception e) {
                return 2;
            }
        }else {
            return 0; 
        }
    }
    
    public Integer updateThanhToan(Integer IdSuKien, Integer IdDoiTac, String Thanhtoan) {
        SuKien existingSuKien = suKienRepository.findByIdSuKienAndIdDoiTac(IdSuKien,IdDoiTac);
        if (existingSuKien!=null) {
        	
        	if(Thanhtoan!=null) {
       		existingSuKien.setThanhToan(Thanhtoan);
       	}
       	 try {
       		suKienRepository.save(existingSuKien);
                return 1;
            } catch (Exception e) {
                return 2;
            }
        }else {
            return 0; 
        }
    }

    public Integer deleteSuKien(Integer IDSuKien,Integer IdDoiTac){
        
    	SuKien sukien = suKienRepository.findByIdSuKienAndIdDoiTac(IDSuKien,IdDoiTac);
        if (sukien!=null) {
        	
        	try {
        		suKienRepository.deleteById(sukien.get_id());
                return 1;
            } catch (Exception e) {
                return 2;
            }
        }else {
            return 0; 
        }
    }



    public SuKienDTO convertToDTO(SuKien suKien) {
    	SuKienDTO suKienDTO = new SuKienDTO();
    	suKienDTO.setIDSuKien(suKien.getIdSuKien());
    	suKienDTO.setIDDoiTac(suKien.getIdDoiTac());
    	suKienDTO.setThanhToan(suKien.getThanhToan());
    	suKienDTO.setAnhNenSuKien(suKien.getAnhNenSuKien());
    	suKienDTO.setTenSuKien(suKien.getTenSuKien());
    	suKienDTO.setTheLoai(suKien.getTheLoai());
    	suKienDTO.setAnhSoDoGhe(suKien.getAnhSoDoGhe());
    	suKienDTO.setThongTinSuKien(suKien.getThongTinSuKien());
    	suKienDTO.setDiaChi(suKien.getDiaChi());
    	suKienDTO.setDuongDan(suKien.getDuongDan());
    	suKienDTO.setLoiCamOn(suKien.getLoiCamOn());
    	// Convert DiaDiem
    	if(suKien.getDiaDiem()!=null) {
    		 DiaDiemDTO diaDiemDTO = convertDiaDiemToDTO(suKien.getDiaDiem());
    	     suKienDTO.setDiaDiem(diaDiemDTO);
    	}
       
        return suKienDTO;
    }
    public DiaDiemDTO convertDiaDiemToDTO(DiaDiem diaDiem) {
    	DiaDiemDTO diaDiemDTO = new DiaDiemDTO();
    	diaDiemDTO.setQuocGia(diaDiem.getQuocGia());
    	diaDiemDTO.setThanhPho(diaDiem.getThanhPho());
    	diaDiemDTO.setNoiToChuc(diaDiem.getNoiToChuc());
    	return diaDiemDTO;
    }
    public DiaDiem convertDiaDiemToEntity(DiaDiemDTO diaDiemDTO) {
    	DiaDiem diaDiem = new DiaDiem();
    	diaDiem.setQuocGia(diaDiemDTO.getQuocGia());
    	diaDiem.setThanhPho(diaDiemDTO.getThanhPho());
    	diaDiem.setNoiToChuc(diaDiemDTO.getNoiToChuc());
    	return diaDiem;
    }

}
