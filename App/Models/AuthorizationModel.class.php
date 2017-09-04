<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/31/17
 * Time: 13:52
 */

namespace App\Models;

/**
 * Class AuthorizationModel
 *
 * @package App\Models
 */
class AuthorizationModel extends \Core\Model
{
	/**
	 * Функція перевіря правильність введення поля 'name' у формі реєстрації.
	 *
	 * Коректним ім'ям вважається рядок довжиною понад 3 символи, на першому
	 * місці може стояти велика літера, на інших - ні
	 *
	 * @param string $name
	 * @return bool
	 */
	public static function nameValidation($name)
	{
		$pattern = '/^[A-Z][a-z]{2,15}$/';
		if (preg_match($pattern, $name) || $name == "") {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Функція перевіряє чи правильно користувач ввів 'surname'.
	 *
	 * Коректним ім'ям вважається рядок довжиною понад 3 символи, на першому
	 * місці може стояти велика літера, на інших - ні
	 *
	 * @param string $surname
	 * @return bool
	 */
	public static function surnameValidation($surname)
	{
		$pattern = '/^[A-Z][a-z]{2,31}$/';
		if (preg_match($pattern, $surname) || $surname == "") {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Функція перевірки логіну.
	 *
	 * Правильний логін - логін із літерами, цифрами та символами "_"/"-". Починається
	 * з літери.
	 *
	 * @param $login
	 * @return bool
	 */
	public static function loginValidation($login)
	{
		$pattern = '/^[a-z0-9_-]{3,16}$/';
		if (preg_match($pattern, $login)) {

			try {
				$db = static::getDB();
				$sql = "SELECT *
						FROM `users`
						WHERE `login`=?;";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(1, $login);
				$stmt->execute();
				$row = $stmt->fetch();
				if ($row) {
					return false;
				}
			} catch (\PDOException $e) {
				$e->getMessage();
			}
			return true;
		} else {
			return false;
		}
	}

	/**
	 * emailValidation
	 *
	 * Check email in DB
	 *
	 * @param string $email
	 * @return bool
	 */
	public static function emailValidation($email)
	{
		try {
			$db = static::getDB();
			$sql = '
			SELECT *
			FROM `users`
			WHERE `email`=?;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(1, $email);
			$stmt->execute();
			$row = $stmt->fetch(\PDO::FETCH_OBJ);
			if ($row) {
				return false;
			}
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return true;
	}

	/**
	 * Функція перевірки коректності введеного паролю та відповідності паролей між собою.
	 *
	 * Пароль повинен містити від 6 до 18 символів:
	 * a-z
	 * A-Z
	 * 1-9
	 * _-@$
	 *
	 * @param string $password1
	 * @param string $password2
	 * @return bool
	 */
	public static function passwordValidation($password1, $password2)
	{
		$pattern = '/^[\w-@$]{6,18}$/';
		if ($password1 === $password2 && preg_match($pattern, $password1)) {
			return true;
		} else {
			return false;
		}
	}

	public static function checkUserInDb($login)
	{
		try {
			$db = static::getDB();
			$sql = '
			SELECT *
			FROM `users`
			WHERE `login`=?
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(1, $login);
			$stmt->execute();
			$row = $stmt->fetch(\PDO::FETCH_OBJ);
			return $row;
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}
}
