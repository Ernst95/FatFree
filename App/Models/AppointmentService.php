<?php

    class AppointmentService extends DB\SQL\Mapper {

        public function __construct(DB\SQL $db) {
            parent::__construct($db, 'appointment_service');
        }

        public function getAll($disabled) {

            try {

                $query = "SELECT * FROM appointment_service WHERE disabled = $disabled";

                $result = $this->db->exec($query);
    
                return $result;

            }
            catch(Exception $e) {

                throw new Exception($e);

            }            

        }

        public function getById($appointmentId, $serviceId) {

            try {

                $query = "SELECT * FROM appointment_service WHERE appointmentId = $appointmentId AND serviceId = $serviceId AND disabled = 0";

                $result = $this->db->exec($query);
    
                return $result;

            }
            catch(Exception $e) {

                throw new Exception($e);

            }

        }

        public function getAppointmentById($appointmentId) {

            try {

                $query = "SELECT * FROM appointment_service WHERE appointmentId = $appointmentId AND disabled = 0";

                $this->db->exec($query);
    
                return $result;

            }
            catch(Exception $e) {

                throw new Exception($e);

            }

        }

        public function create($data) {

            try {

                $this->load(array('appointmentId = ? AND serviceId = ?', $data['appointmentId'], $data['serviceId']));

                $this->copyFrom($data);
    
                $this->save();
                
            }
            catch(Exception $e) {

                throw new Exception($e);

            }

        }

        public function delete($data) {

            try {

                $this->load(array('appointmentId = ? AND serviceId = ?', $data['appointmentId'], $data['serviceId']));

                $this->copyFrom($data);
    
                $this->save();
                
            }
            catch(Exception $e) {

                throw new Exception($e);

            }

        }

    }

?>