package ProductApplication.service;


import java.util.ArrayList;
import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import ProductApplication.DTO.VeDTO;
import ProductApplication.model.Ve;
import ProductApplication.repository.VeRepository;


@Service
public class VeService {
    @Autowired
    private VeRepository veRepository;

    public List<VeDTO> getAllVe() {
    	List<Ve> veList = veRepository.findAll();
    	if (veList.isEmpty()) {
            return null; 
        }
        List<VeDTO> veListDTO = new ArrayList<>();
        for (Ve ve : veList) {
            veListDTO.add(convertToDTO(ve));
        }
        return veListDTO;
    }

//    public VeDTO getVeByIDVe(Integer IDVe) {
//        Ve veList = veRepository.findByIDVe(IDVe);
//        if (veList!=null) {
//            return convertToDTO(veList);
//        }else {
//            return null; 
//        }
//       
//    }
    
    public List<VeDTO> getVeByIdSuKienAndIdSuatDienAndIdDoiTac(Integer idSuKien,Integer idSuatDien,Integer idDoiTac) {
        List<Ve> veList = veRepository.findByIDSuKienAndIDSuatDienAndIDDoiTac(idSuKien,idSuatDien,idDoiTac);
        if (veList.isEmpty()) {
            return null; 
        }
        List<VeDTO> veListDTO = new ArrayList<>();
        for (Ve ve : veList) {
            veListDTO.add(convertToDTO(ve));
        }
        return veListDTO;
    }

    public Integer createVe(VeDTO veDTO) {
        Ve ve = new Ve();
        System.out.println("loai ve"+veDTO.getIdloaiVe());
        ve.setiDVe(veDTO.getIdve());
        ve.setiDLoaiVe(veDTO.getIdloaiVe());
        ve.setiDSuKien(veDTO.getIdsuKien());
        ve.setSoSeri(veDTO.getSoSeri());
        ve.setTrangThaiBan(veDTO.getTrangThaiBan());
        ve.setTrangThaiDung(veDTO.getTrangThaiDung());
        
        try {
        	veRepository.save(ve);
            return 1;
        } catch (Exception e) {
            return 0;
        }
    }
    
    public Integer updateVe(Integer iDVe,Integer iDLoaiVe,Integer iDSuatDien,Integer iDDoiTac,Integer iDSuKien, String soSeri,String trangThaiBan,String trangThaiDung) {
        Ve ve = veRepository.findByIDVeAndIDSuKienAndIDDoiTac(iDVe, iDSuKien,iDDoiTac);
        if (ve!=null) {
        	ve.setiDVe(iDVe);
            ve.setiDLoaiVe(iDLoaiVe);
            ve.setiDSuatDien(iDSuatDien);
            ve.setiDDoiTac(iDDoiTac);
            ve.setiDSuKien(iDSuKien);
            ve.setSoSeri(soSeri);
            ve.setTrangThaiBan(trangThaiBan);
            ve.setTrangThaiDung(trangThaiDung);
            try {
            	veRepository.save(ve);
                return 1;
            } catch (Exception e) {
                return 2;
            }
        }else {
            return 0; 
        }
    }

    public Integer deleteVe(Integer iDVe,Integer iDSuKien,Integer iDDoiTac) {
        
        Ve ve = veRepository.findByIDVeAndIDSuKienAndIDDoiTac(iDVe, iDSuKien,iDDoiTac);
        if (ve!=null) {
        	
        	try {
        		veRepository.deleteById(ve.get_id());
                return 1;
            } catch (Exception e) {
                return 2;
            }
        }else {
            return 0; 
        }
    }
    
    
    public List<VeDTO> getVeByIdLoaiVeAndIdSuKienAndIdSuatDienAndIdDoiTac(Integer iDLoaiVe, Integer iDSuKien,Integer iDSuatDien,Integer iDDoiTac) {
        List<Ve> veList = veRepository.findByIDLoaiVeAndIDSuKienAndIDSuatDienAndIDDoiTac(iDLoaiVe, iDSuKien, iDSuatDien, iDDoiTac);
        if (veList.isEmpty()) {
            return null; 
        }
        List<VeDTO> veListDTO = new ArrayList<>();
        for (Ve ve : veList) {
            veListDTO.add(convertToDTO(ve));
        }
        return veListDTO;
    }
    
    public VeDTO getVeByIdVeAndIDSuKienAndIDDoiTac(Integer iDVe, Integer iDSuKien,Integer iDDoiTac) {
        Ve ve = veRepository.findByIDVeAndIDSuKienAndIDDoiTac(iDVe, iDSuKien,iDDoiTac);
        if (ve!=null) {
            return convertToDTO(ve);
        }else {
            return null; 
        }
    }

    public VeDTO getMotVeChuaBan(Integer iDLoaiVe, Integer iDSuKien,Integer iDSuatDien,Integer iDDoiTac, String trangThaiBan) {
    	List<Ve> veList = veRepository.findByIDLoaiVeAndIDSuKienAndIDSuatDienAndIDDoiTacAndTrangThaiBan(iDLoaiVe, iDSuKien,iDSuatDien,iDDoiTac, trangThaiBan);
        if (veList.isEmpty()) {
            return null; 
        }
        Ve ve =veList.get(0);
        ve.setTrangThaiBan("Đang xử lý thanh toán");
        Ve saved=veRepository.save(ve);
        return convertToDTO(saved);
    }

    
    public List<VeDTO> getVeByIdLoaiVeAndIdSuKienAndIDSuatDienAndIDDoiTacAndTrangThaiBan(Integer iDLoaiVe, Integer iDSuKien,Integer iDSuatDien,Integer iDDoiTac, String trangThaiBan) {

    	List<Ve> veList = veRepository.findByIDLoaiVeAndIDSuKienAndIDSuatDienAndIDDoiTacAndTrangThaiBan(iDLoaiVe, iDSuKien,iDSuatDien,iDDoiTac, trangThaiBan);
        if (veList.isEmpty()) {
            return null; 
        }
        List<VeDTO> veListDTO = new ArrayList<>();
        for (Ve ve : veList) {
            veListDTO.add(convertToDTO(ve));
        }
        return veListDTO;
    }
    
    public List<VeDTO> getVeByIdSuKienAndIdSuatDienAndIdDoiTacAndTrangThaiBan(Integer iDSuKien,Integer iDSuatDien,Integer iDDoiTac, String trangThaiBan) {
        List<Ve> veList = veRepository.findByIDSuKienAndIDSuatDienAndIDDoiTacAndTrangThaiBan(iDSuKien,iDSuatDien,iDDoiTac, trangThaiBan);
        if (veList.isEmpty()) {
            return null; 
        }

        List<VeDTO> veListDTO = new ArrayList<>();
        for (Ve ve : veList) {
            veListDTO.add(convertToDTO(ve));
        }
        return veListDTO;
    }
    
    public List<VeDTO> getVeByIdSuKienAndIdSuatDienAndIdDoiTacAndTrangThaiDung(Integer iDSuKien,Integer iDSuatDien,Integer iDDoiTac, String trangThaiDung) {
        List<Ve> veList = veRepository.findByIDSuKienAndIDSuatDienAndIDDoiTacAndTrangThaiDung(iDSuKien,iDSuatDien,iDDoiTac, trangThaiDung);
        if (veList.isEmpty()) {
            return null; 
        }

        List<VeDTO> veListDTO = new ArrayList<>();
        for (Ve ve : veList) {
            veListDTO.add(convertToDTO(ve));
        }
        return veListDTO;
    }
    
    public Integer updateTinhTrangVe(Integer iDVe, Integer iDSuKien,Integer iDDoiTac, String trangThaiBan) {
    	Ve ve = veRepository.findByIDVeAndIDSuKienAndIDDoiTac(iDVe, iDSuKien,iDDoiTac);
        if (ve!=null) {
        	 ve.setTrangThaiBan(trangThaiBan);
        	 try {
             	veRepository.save(ve);
                 return 1;
             } catch (Exception e) {
                 return 2;
             }
         }else {
             return 0; 
         }
    }
    
    public Integer updateTrangThaiDung(Integer iDVe, Integer iDSuKien,Integer iDDoiTac, String trangThaiDung) {
    	Ve ve = veRepository.findByIDVeAndIDSuKienAndIDDoiTac(iDVe, iDSuKien,iDDoiTac);
        if (ve!=null) {
        	 ve.setTrangThaiDung(trangThaiDung);
        	 try {
             	veRepository.save(ve);
                 return 1;
             } catch (Exception e) {
                 return 2;
             }
         }else {
             return 0; 
         }
    }
    
    public VeDTO convertToDTO(Ve ve) {
        VeDTO veDTO = new VeDTO();
        veDTO.setIdve(ve.getiDVe());
        veDTO.setIdloaiVe(ve.getiDLoaiVe());
        veDTO.setIdDoiTac(ve.getiDDoiTac());
        veDTO.setIdSuatDien(ve.getiDSuatDien());
        veDTO.setTrangThaiBan(ve.getTrangThaiBan());
        veDTO.setSoSeri(ve.getSoSeri());
        veDTO.setTrangThaiDung(ve.getTrangThaiDung());
        veDTO.setIdsuKien(ve.getiDSuKien());
        return veDTO;
    }

    public Ve convertToEntity(VeDTO veDTO) {
        Ve ve = new Ve();

        ve.setiDVe(veDTO.getIdve());
        ve.setiDLoaiVe(veDTO.getIdloaiVe());
        ve.setiDDoiTac(veDTO.getIdDoiTac());
        ve.setiDSuatDien(veDTO.getIdSuatDien());
        ve.setTrangThaiBan(veDTO.getTrangThaiBan());
        ve.setSoSeri(veDTO.getSoSeri());
        ve.setTrangThaiDung(veDTO.getTrangThaiDung());
        ve.setiDSuKien(veDTO.getIdsuKien());
        return ve;
    }
}