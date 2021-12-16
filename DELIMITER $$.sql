DELIMITER $$
CREATE TRIGGER occupy_trig
AFTER INSERT ON `` FOR EACH ROW
begin
       DECLARE id_exists Boolean;
       -- Check BookingRequest table
       SELECT 1
       INTO @id_exists
       FROM BookingRequest
       WHERE BookingRequest.idRequest= NEW.idRequest;

       IF @id_exists = 1
       THEN
           UPDATE BookingRequest
           SET status = '1'
           WHERE idRequest = NEW.idRequest;
        END IF;
END;
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER next_distance 
AFTER INSERT ON `` FOR EACH ROW
begin
       DECLARE id_exists Boolean;
       -- Check BookingRequest table
       SELECT 1
       INTO @id_exists
       FROM maintenance_vehicle
       WHERE maintenance_vehicle.maintenance_vehicle_ID= NEW.maintenance_vehicleid;

       IF @id_exists = 1
       THEN
           UPDATE maintenance_vehicle
           SET vehicle.odo_reading = vehicle.odo_reading + New.total_running 
           WHERE maintenance_vehicle.maintenance_vehicle_ID= NEW.maintenance_vehicleid;
        END IF;
END
$$
DELIMITER ;