<?php

    class AppointmentService extends DB\SQL\Mapper {

        public function __construct(DB\SQL $db) {
            parent::__construct($db, 'appointment_service');
        }

        public function getAll($disabled) {

            $query = "SELECT * FROM appointment_service WHERE disabled = $disabled";

            $result = $this->db->exec($query);

            return $result;

        }

        public function getById($appointmentId, $serviceId) {

            $query = "SELECT * FROM appointment_service WHERE appointmentId = $appointmentId AND serviceId = $serviceId AND disabled = 0";

            $result = $this->db->exec($query);

            return $result;

        }

        public function getAppointmentById($appointmentId) {

            $query = "SELECT * FROM appointment_service WHERE appointmentId = $appointmentId AND disabled = 0";

            $this->db->exec($query);

            return $result;

        }

        public function create($data) {

            $this->load(array('appointmentId = ? AND serviceId = ?', $data['appointmentId'], $data['serviceId']));

            $this->copyFrom($data);

            $this->save();

        }

        public function delete($data) {

            $this->load(array('appointmentId = ? AND serviceId = ?', $data['appointmentId'], $data['serviceId']));

            $this->copyFrom($data);

            $this->save();

        }


    }


?>