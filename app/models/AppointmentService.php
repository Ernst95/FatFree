<?php

    class AppointmentService extends DB\SQL\Mapper {

        public function __construct(DB\SQL $db) {
            parent::__construct($db, 'appointment_service');
        }

        public function getAll($disabled) {

            try {

                $query = "SELECT * FROM appointment_service WHERE disabled = $disabled GROUP BY appointmentId";

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

                $result = $this->db->exec($query);
    
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

        public function getAppointmentByYearAndMonthByUserId($userId, $year, $month) {

            try {

                $query = "
                SELECT
                    u.title,
                    u.firstName,
                    u.lastName,
                    u.mobileNumber,
                    u.email,
                    ap.date,
                    ap.custUserId,
                    ap.empUserId,
                    DATE_FORMAT(ap.date, '%Y') AS year,
                    DATE_FORMAT(ap.date, '%m') AS month,
                    DATE_FORMAT(ap.date, '%e') AS day
                FROM 
                    appointment ap
                LEFT JOIN user u ON
                    u.userId = ap.custUserId
                WHERE
                    ap.empUserId = '$userId' AND
                    ap.disabled = 0 AND
                    YEAR(ap.date) = $year AND
                    MONTH(ap.date) = $month
                ORDER BY
                    ap.date
                ";

                $result = $this->db->exec($query);
    
                return $result;

            }
            catch(Exception $e) {

                throw new Exception($e);

            }

        }

        public function getAppointmentByDayByUserId($userId, $year, $month, $day) {

            try {

                $query = "
                SELECT
                    aps.appointmentId,
                    ap.date appointmentDate,
                    ap.custUserId,
                    ap.empUserId,
                    DATE_FORMAT(ap.date, '%Y') AS year,
                    DATE_FORMAT(ap.date, '%m') AS month,
                    DATE_FORMAT(ap.date, '%e') AS day,
                    aps.serviceId,
                    s.name AS serviceName,
                    s.price AS servicePrice,
                    u.title,
                    u.firstName,
                    u.lastName,
                    u.mobileNumber,
                    u.email
                FROM 
                    appointment ap
                LEFT JOIN appointment_service aps ON
                    aps.appointmentId = ap.id
                LEFT JOIN service s ON
                    s.id = aps.serviceId
                LEFT JOIN user u ON
                    u.userId = ap.custUserId
                WHERE
                    ap.empUserId = '$userId' AND
                    ap.disabled = 0 AND
                    YEAR(ap.date) = $year AND
                    MONTH(ap.date) = $month AND
                    DAY(ap.date) = $day
                ORDER BY
                    ap.date
                ";

                $result = $this->db->exec($query);
    
                return $result;

            }
            catch(Exception $e) {

                throw new Exception($e);

            }

        }

    }

?>