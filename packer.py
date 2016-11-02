infile = open(input("file yang mau di pack: "),"r")
outfile = open(input("file keluarannya: "),"w")

arr = infile.read().split("\n")
outfile.write("".join(arr))

infile.close()
outfile.close()