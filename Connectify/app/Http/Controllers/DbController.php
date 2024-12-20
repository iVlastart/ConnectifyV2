<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use mysqli;
    use mysqli_sql_exception;

    class DbController extends Controller
    {
        private static $conn;

        public static function connect()
        {
            try
            {
                self::$conn = new mysqli("localhost", "root", "", "connectifydb");
                if (self::$conn->connect_error) {
                    throw new mysqli_sql_exception("Connection failed: " . self::$conn->connect_error);
                }
            }
            catch (mysqli_sql_exception $e)
            {
                echo "Something went wrong: " . $e->getMessage();
            }
        }

        public static function query($query, ...$params)
        {
            if (!self::$conn) {
                self::connect();
            }

            try
            {
                $stmt = self::$conn->prepare($query);

                if ($stmt === false) {
                    throw new mysqli_sql_exception("Prepare failed: " . self::$conn->error);
                }

                if ($params) {
                    // Get types of parameters for bind_param
                    $types = str_repeat('s', count($params)); // Assuming all parameters are strings; adjust if necessary
                    $stmt->bind_param($types, ...$params);
                }

                $stmt->execute();

                if ($stmt->error) {
                    throw new mysqli_sql_exception("Execute failed: " . $stmt->error);
                }

                $result = $stmt->get_result();

                if ($result) {
                    return $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    return true; // If the query was an INSERT/UPDATE/DELETE, etc.
                }
            }
            catch (mysqli_sql_exception $e)
            {
                echo "Query error: " . $e->getMessage();
            }
        }

        public static function queryAll($query, ...$params)
        {
            if (!self::$conn) {
                self::connect();
            }

            try
            {
                $stmt = self::$conn->prepare($query);

                if ($stmt === false) {
                    throw new mysqli_sql_exception("Prepare failed: " . self::$conn->error);
                }

                if ($params) {
                    // Get types of parameters for bind_param
                    $types = str_repeat('s', count($params)); // Assuming all parameters are strings; adjust if necessary
                    $stmt->bind_param($types, ...$params);
                }

                $stmt->execute();

                if ($stmt->error) {
                    throw new mysqli_sql_exception("Execute failed: " . $stmt->error);
                }

                $result = $stmt->get_result();

                if ($result) {
                    return $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    return true; // If the query was an INSERT/UPDATE/DELETE, etc.
                }
            }
            catch (mysqli_sql_exception $e)
            {
                echo "Query error: " . $e->getMessage();
            }
        }
    }