from datetime import datetime
from termcolor import colored


def make_safe_filename(s):
    def safe_char(c):
        if c.isalnum() or c=='.':
            return c
        else:
            return "_"

    safe = ""
    last_safe=False
    for c in s:
      if len(safe) > 200:
        return safe + "_" + str(time.time_ns() // 1000000)

      safe_c = safe_char(c)
      curr_safe = c != safe_c
      if not last_safe or not curr_safe:
        safe += safe_c
      last_safe=curr_safe
    return safe   

def string_time():
  now = datetime.now()
  dt_string = now.strftime("%d/%m/%Y %H:%M:%S")
  return dt_string

def _info(s):
  print(colored('\r\n'+s+'\r','white','on_blue'))
def _err(s):
  print(colored('\r\n'+s+'\r','white','on_red'))