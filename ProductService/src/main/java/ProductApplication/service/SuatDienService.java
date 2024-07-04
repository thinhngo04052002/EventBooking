package ProductApplication.service;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import ProductApplication.DTO.AgendaDTO;
import ProductApplication.DTO.LoaiVeDTO;
import ProductApplication.DTO.NhanSuDTO;
import ProductApplication.DTO.SuatDienDTO;
import ProductApplication.DTO.SuatDienItemDTO;
import ProductApplication.model.SuatDien;
import ProductApplication.model.SuatDienItem;
import ProductApplication.model.Agenda;
import ProductApplication.model.LoaiVe;
import ProductApplication.model.NhanSu;
import ProductApplication.repository.SuatDienRepository;

import java.util.ArrayList;
import java.util.List;

@Service
public class SuatDienService {

    @Autowired
    private SuatDienRepository suatDienRepository;

    
    
    public SuatDienDTO convertToDTO(SuatDien suatDien) {
        SuatDienDTO suatDienDTO = new SuatDienDTO();
        suatDienDTO.setIDSuKien(suatDien.getIDSuKien());
        suatDienDTO.setIDDoiTac(suatDien.getIDDoiTac());
        if (suatDien.getSuatDienItem() != null) {
        	List<SuatDienItemDTO> suatDienItemsDTO = new ArrayList<>();
        	for (SuatDienItem suatDienItem : suatDien.getSuatDienItem()) {
        		suatDienItemsDTO.add(convertSuatDienItemToDTO(suatDienItem));
            }
        	suatDienDTO.setSuatDienItemDTO(suatDienItemsDTO);
        }
        
        return suatDienDTO;
    }
    
    public SuatDienItem convertSuatDienItemToEntity(SuatDienItemDTO suatDienItemDTO) {
    	
    	SuatDienItem suatDienItem= new SuatDienItem();
    	
    	suatDienItem.setSoThuTu(suatDienItemDTO.getSoThuTu());
    	suatDienItem.setThoiGianBatDau(suatDienItemDTO.getThoiGianBatDau());
    	suatDienItem.setThoiGianKetThuc(suatDienItemDTO.getThoiGianKetThuc());
    	
    	if (suatDienItemDTO.getAgenda() != null) {
    		List<Agenda> agenda = new ArrayList<>();
    		for (AgendaDTO agendaDTO : suatDienItemDTO.getAgenda()) {
    			agenda.add(convertAgendaToEntity(agendaDTO));
            }
    		suatDienItem.setAgenda(agenda);
    	}
    	
    	if (suatDienItemDTO.getLoaiVe() != null) {
    		List<LoaiVe> loaiVe = new ArrayList<>();
    		for (LoaiVeDTO lv : suatDienItemDTO.getLoaiVe()) {
    			loaiVe.add(convertLoaiVeToEntity(lv));
            }
    		suatDienItem.setLoaiVe(loaiVe);
    	}
    	
    	if (suatDienItemDTO.getNguoiThamGia() != null) {
    		List<String> nguoiThamGia = new ArrayList<>();
    		for (String ntg : suatDienItemDTO.getNguoiThamGia()) {
    			nguoiThamGia.add(ntg);
            }
    		suatDienItem.setNguoiThamGia(nguoiThamGia);
    	}
    	if (suatDienItemDTO.getNhanSu() != null) {
    		List<NhanSu> nhanSu = new ArrayList<>();
    		for (NhanSuDTO nhanSuDTO : suatDienItemDTO.getNhanSu()) {
    			nhanSu.add(convertNhanSuToEntity(nhanSuDTO));
            }
    		suatDienItem.setNhanSu(nhanSu);
    	}
    	return suatDienItem;
    }

    public SuatDienItemDTO convertSuatDienItemToDTO(SuatDienItem suatDienItem) {
    	
    	SuatDienItemDTO suatDienItemDTO = new SuatDienItemDTO();
    	
    	suatDienItemDTO.setSoThuTu(suatDienItem.getSoThuTu());
    	suatDienItemDTO.setThoiGianBatDau(suatDienItem.getThoiGianBatDau());
    	suatDienItemDTO.setThoiGianKetThuc(suatDienItem.getThoiGianKetThuc());
    	
    	if (suatDienItem.getAgenda() != null) {
    		List<AgendaDTO> agendaDTO = new ArrayList<>();
    		for (Agenda agenda : suatDienItem.getAgenda()) {
    			agendaDTO.add(convertAgendaToDTO(agenda));
            }
    		suatDienItemDTO.setAgenda(agendaDTO);
    	}
    	
    	if (suatDienItem.getLoaiVe() != null) {
    		List<LoaiVeDTO> loaiVeDTO = new ArrayList<>();
    		for (LoaiVe lv : suatDienItem.getLoaiVe()) {
    			loaiVeDTO.add(convertLoaiVeToDTO(lv));
            }
    		suatDienItemDTO.setLoaiVe(loaiVeDTO);
    	}
    	
    	if (suatDienItem.getNguoiThamGia() != null) {
    		List<String> nguoiThamGiaDTO = new ArrayList<>();
    		for (String ntg : suatDienItem.getNguoiThamGia()) {
    			nguoiThamGiaDTO.add(ntg);
            }
    		suatDienItemDTO.setNguoiThamGia(nguoiThamGiaDTO);
    	}
    	if (suatDienItem.getNhanSu() != null) {
    		List<NhanSuDTO> nhanSuDTO = new ArrayList<>();
    		for (NhanSu nhanSu : suatDienItem.getNhanSu()) {
    			nhanSuDTO.add(convertNhanSuToDTO(nhanSu));
            }
    		suatDienItemDTO.setNhanSu(nhanSuDTO);
    	}
    	return suatDienItemDTO;
    }
    
    public AgendaDTO convertAgendaToDTO(Agenda agenda) {
    	AgendaDTO agendaDTO = new AgendaDTO();
    	agendaDTO.setHoatDong(agenda.getHoatDong());
    	agendaDTO.setThoiGian(agenda.getThoiGian());
    	return agendaDTO;
    }
    
    public Agenda convertAgendaToEntity(AgendaDTO agendaDTO) {
    	Agenda agenda = new Agenda();
    	agenda.setHoatDong(agendaDTO.getHoatDong());
    	agenda.setThoiGian(agendaDTO.getThoiGian());
    	return agenda;
    }
    
    public LoaiVeDTO convertLoaiVeToDTO(LoaiVe loaiVe) {
    	LoaiVeDTO loaiVeDTO = new LoaiVeDTO();
    	loaiVeDTO.setiDLoaiVe(loaiVe.getiDLoaiVe());
    	loaiVeDTO.setGiaVe(loaiVe.getGiaVe());
    	loaiVeDTO.setMoTa(loaiVe.getMoTa());
    	loaiVeDTO.setSoLuong(loaiVe.getSoLuong());
    	loaiVeDTO.setSoVeToiDaTrongMotDonHang(loaiVe.getSoVeToiDaTrongMotDonHang());
    	loaiVeDTO.setTenLoaiVe(loaiVe.getTenLoaiVe());
    	loaiVeDTO.setThoiGianBatDauBanVe(loaiVe.getThoiGianBatDauBanVe());
    	loaiVeDTO.setThoiGianKetThucBanVe(loaiVe.getThoiGianKetThucBanVe());
    	return loaiVeDTO;
    }
    
    public LoaiVe convertLoaiVeToEntity(LoaiVeDTO loaiVeDTO) {
    	LoaiVe loaiVe = new LoaiVe();
    	loaiVe.setiDLoaiVe(loaiVeDTO.getiDLoaiVe());
    	loaiVe.setGiaVe(loaiVeDTO.getGiaVe());
    	loaiVe.setMoTa(loaiVeDTO.getMoTa());
    	loaiVe.setSoLuong(loaiVeDTO.getSoLuong());
    	loaiVe.setSoVeToiDaTrongMotDonHang(loaiVeDTO.getSoVeToiDaTrongMotDonHang());
    	loaiVe.setTenLoaiVe(loaiVeDTO.getTenLoaiVe());
    	loaiVe.setThoiGianBatDauBanVe(loaiVeDTO.getThoiGianBatDauBanVe());
    	loaiVe.setThoiGianKetThucBanVe(loaiVeDTO.getThoiGianKetThucBanVe());
    	return loaiVe;
    }
    
    public NhanSuDTO convertNhanSuToDTO(NhanSu nhanSu) {
    	NhanSuDTO nhanSuDTO = new NhanSuDTO();
    	nhanSuDTO.setEmail(nhanSu.getEmail());
    	nhanSuDTO.setSoDienThoai(nhanSu.getSoDienThoai());
    	nhanSuDTO.setTen(nhanSu.getTen());
    	nhanSuDTO.setVaiTro(nhanSu.getVaiTro());
    	return nhanSuDTO;
    }
    
    public NhanSu convertNhanSuToEntity(NhanSuDTO nhanSuDTO) {
    	NhanSu nhanSu = new NhanSu();
    	nhanSu.setEmail(nhanSuDTO.getEmail());
    	nhanSu.setSoDienThoai(nhanSuDTO.getSoDienThoai());
    	nhanSu.setTen(nhanSuDTO.getTen());
    	nhanSu.setVaiTro(nhanSuDTO.getVaiTro());
    	return nhanSu;
    }
    
    public List<SuatDienDTO> getAllSuatDien() {
        List<SuatDien> suatDienList = suatDienRepository.findAll();
        if (suatDienList.isEmpty()) {
            return null; 
        }
        List<SuatDienDTO> suatDienDTOList = new ArrayList<>();
        for (SuatDien suatDien : suatDienList) {
            suatDienDTOList.add(convertToDTO(suatDien));
        }
        return suatDienDTOList;
    }

    public SuatDienDTO getSuatDienByIdSuKienAndIdDoiTac(Integer IDSuKien,Integer IdDoiTac) {
    	SuatDien suatDien = suatDienRepository.findByIDSuKienAndIDDoiTac(IDSuKien,IdDoiTac);
        if (suatDien!=null) {
            return convertToDTO(suatDien);
        }else {
            return null; 
        }
    }
    
    public List<LoaiVeDTO> getLoaiVeByIdSuatDienAndIdSuKienAndIdDoiTac(Integer IDSuatDien,Integer IDSuKien,Integer IDDoiTac){
    	SuatDien suatDien = suatDienRepository.findByIDSuKienAndIDDoiTac(IDSuKien, IDDoiTac);
    	if (suatDien==null) {
            return null; 
        }
    	List<LoaiVeDTO> loaiVeDTOList = new ArrayList<>();
            List<SuatDienItem> suatDienItems = suatDien.getSuatDienItem();
            for (SuatDienItem suatDienItem : suatDienItems) {
                if (suatDienItem.getSoThuTu().equals(IDSuatDien)) {
                    List<LoaiVe> loaiVeList = suatDienItem.getLoaiVe();
                    for(LoaiVe ds:loaiVeList) {
                    	loaiVeDTOList.add(convertLoaiVeToDTO(ds));
                    }
                }
        }
            
            return loaiVeDTOList;
}
    
    public Integer createSuatDien(Integer idSuKien,Integer idDoiTac,SuatDienItemDTO suatDienItemDTO) {
        SuatDien suatDien = suatDienRepository.findByIDSuKienAndIDDoiTac(idSuKien,idDoiTac);
        SuatDienItem newSuatDien= convertSuatDienItemToEntity(suatDienItemDTO);
        if(suatDien==null) {
        	suatDien = new SuatDien();
        	suatDien.setIDSuKien(idSuKien);
            suatDien.setIDDoiTac(idDoiTac);
            suatDien.setSuatDienItem(new ArrayList<>());
        }
        List<SuatDienItem> suatDienItem= suatDien.getSuatDienItem();
    	int sttMax = suatDienItem.size();
    	newSuatDien.setSoThuTu(sttMax+1);
    	suatDienItem.add(newSuatDien);
    	suatDien.setSuatDienItem(suatDienItem);
        try {
        	suatDienRepository.save(suatDien);
        	//gen ve theo soluong
            return 1;
        } catch (Exception e) {
            return 0;
        }
    }


    public Integer updateSuatDienItem(Integer IDSuKien, Integer IDSuatDien, Integer IDDoiTac, SuatDienItemDTO suatDienItemDTO) {
        SuatDien existingSuatDien = suatDienRepository.findByIDSuKienAndIDDoiTac(IDSuKien, IDDoiTac);

        if (existingSuatDien != null) {
            List<SuatDienItem> suatDienItems = existingSuatDien.getSuatDienItem();
            boolean itemUpdated = false;

            for (int i = 0; i < suatDienItems.size(); i++) {
                SuatDienItem sd = suatDienItems.get(i);
                if (sd.getSoThuTu().equals(IDSuatDien)) {
                    SuatDienItem updatedSuatDienItem = convertSuatDienItemToEntity(suatDienItemDTO);
                    updatedSuatDienItem.setSoThuTu(IDSuatDien);
                    suatDienItems.set(i, updatedSuatDienItem);
                    itemUpdated = true;
                    break;
                }
            }

            if (itemUpdated) {
                existingSuatDien.setSuatDienItem(suatDienItems);
                try {
                    suatDienRepository.save(existingSuatDien);
                    return 1;
                } catch (Exception e) {
                    return 2;
                }
            } else {
                return 0; // Không tìm thấy SuatDienItem với SoThuTu đã cho
            }
        } else {
            return 0; // Không tìm thấy SuatDien
        }
    }
    
    public Integer deleteSuatDien(Integer IDSuKien,Integer IDDoiTac) {
        SuatDien suatDien = suatDienRepository.findByIDSuKienAndIDDoiTac(IDSuKien,IDDoiTac);
        if (suatDien!=null) {
        	
        	try {
        		suatDienRepository.deleteById(suatDien.get_id());
                return 1;
            } catch (Exception e) {
                return 2;
            }
        }else {
            return 0; 
        }
    }
    

    public Integer deleteSuatDienItem(Integer IDSuKien,Integer IDDoiTac,Integer IDSuatDien) {
    	
        SuatDien suatDien = suatDienRepository.findByIDSuKienAndIDDoiTac(IDSuKien,IDDoiTac);
        if (suatDien!=null) {
        	List<SuatDienItem> suatDienItems = suatDien.getSuatDienItem();
        	SuatDienItem suatDienItemToDelete = null;
            for (SuatDienItem suatDienItem : suatDienItems) {
                if (suatDienItem.getSoThuTu().equals(IDSuatDien)) {
                    suatDienItemToDelete = suatDienItem;
                    break;
                }
            }
            if (suatDienItemToDelete != null) {
                suatDienItems.remove(suatDienItemToDelete);
                suatDien.setSuatDienItem(suatDienItems);
                try {
                    suatDienRepository.save(suatDien);
                    return 1; // Trả về 1 nếu xóa thành công
                } catch (Exception e) {
                    return 2; // Trả về 2 nếu có lỗi khi lưu SuatDien
                }
            } else {
                return 0; // Trả về 0 nếu không tìm thấy SuatDienItem cần xóa
            }
        }else {
            return 0; 
        }
    }
}
