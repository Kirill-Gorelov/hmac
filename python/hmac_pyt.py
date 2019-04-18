import hmac
import hashlib
import urllib.parse

key = 'test_key_private'

arr = {
    'login':'My_login',
    'email':'My_email',
    'password':'My_pass'
    }

class Hmac:
    # создаем подпись
    def make_data_hmac(self,data,key):
        serialize_data = self.serialize_dict(self.sort_dict(data))
        return self.make_signature(serialize_data,key)

    #сортируем массив по ключам
    def sort_dict(self, data):
        new_dict = {}
        for key in sorted(data.keys()):
            new_dict[key]=data[key]
        return new_dict

    # приводим к одному типу сериализации
    def serialize_dict(self, data):
        return urllib.parse.urlencode(data)

    # создаем подпись
    def make_signature(self, data, key):
        return hmac.new(key.encode(), data.encode('utf-8'), hashlib.sha256).hexdigest()

    # проверка подписи
    def check_data_hmac(self, data, key, sign_param_name):
        serialize_data = self.serialize_dict(self.sort_dict(data))
        origin_hmac = self.make_signature(serialize_data,key)
        if origin_hmac.lower() == sign_param_name.lower():
            return True
        else:
            return False


hmac_p = Hmac()
r = hmac_p.make_data_hmac(arr,key)
print(r)

rez = hmac_p.check_data_hmac(arr,key,r)
print(rez)