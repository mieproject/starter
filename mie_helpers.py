import requests,subprocess,os.path,time,re,glob
from datetime import datetime
from termcolor import colored


def generate_mierun_file(mierun_files,precmd,str_glob_pattern,module = ''):
  #sort mierun_files
  mierun_sort = open('./mierun_sort', 'r')
  mierun_sort_lines = mierun_sort.read().split()
  mierun_sort_lines = [str_glob_pattern.replace('*',element) for element in mierun_sort_lines]
  mierun_files_sorted = []
  for i in mierun_sort_lines:
    if i in mierun_files:
      mierun_files_sorted.append(i)
    temp3 = [item for item in mierun_files if item not in mierun_files_sorted]
    mierun_files = mierun_files_sorted+temp3

  #remove old temp files
  tempfiles = glob.glob(os.path.join('/tmp', 'mieproject_*.mierun'))
  for f in tempfiles:
      os.remove(f)
  # create a temp file
  tmp_path = os.path.join('/tmp', 'mieproject_{}.mierun'.format(time.time()))
  print("Creating one temporary file for .mierun ...",tmp_path)
  tmpf = open(tmp_path, "w+")
  for mierun_file in mierun_files:
    if(os.path.isfile(mierun_file)):
      with open(mierun_file) as f:
        lines = f.readlines()
        for line in lines:
          tmpf.write(line)

          #   print(line)
    else:
      _info('mierun file not exist for module: '+module)
  tmpf.close()
  parse_mierun_file(tmp_path,precmd)

def parse_mierun_file(mierun_file,precmd,module = ''):
  print(mierun_file,precmd)
  with open(mierun_file) as f:
    content = f.read()
    print(content)

    lines = re.split('&&|\n',content)
    filtered_lines = []
    for line in lines:
      if(line.strip() != ""):
        #yellow
        print(colored('\r\n[mierun@module:{}]${} \r'.format(module,line),'yellow'))
        subprocess.call(precmd+line, shell=True)
        # filtered_lines.append(line.strip())
        # filtered_lines.append(line)
    # filtered_lines = list(dict.fromkeys(filtered_lines))
    # print(filtered_lines)



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
