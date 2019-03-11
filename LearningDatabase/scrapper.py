import requests
import bs4
import random
res=requests.get("https://hackr.io/")
soup=bs4.BeautifulSoup(res.text,"lxml")
courses=soup.findAll('a',attrs={'class':'topic-grid-item'})
cfile=open("C:\\Users\\Sagar\\Desktop\\Web Crawling\\cfile.txt","w")
tfile=open("C:\\Users\\Sagar\\Desktop\\Web Crawling\\tfile.txt","w")
ccount=0
users=30
type=['Free','Paid']
content=['Video','Book','Only Reading']
level=['Beginner', 'Intermediate', 'Advanced']
for i in courses:
        ccount+=1
        print(ccount,i.text.strip())
        s=str(ccount)+"~"+i.text.strip()+"\n"
        cfile.write(s)
        #print(i['href'])
        r=requests.get(i['href'])
        sp=bs4.BeautifulSoup(r.text,'lxml')
        tut=sp.findAll('div',attrs={'class':'tut-list-primary'})
        tcount=0
        for i in tut:
                tcount+=1
                upvts=i.find('span',attrs={'class':'count'}).text
                title=i.find('span',attrs={'class':'tutorial-title-txt'}).text
                # author=i.find('div',attrs={'class':'action author'}).text
                #print('>>>>',title,upvts)
                link=i.find('a',attrs={'class':'js-tutorial-title'})['href']
                rr=requests.get(link)
                ssp=sp=bs4.BeautifulSoup(rr.text,'lxml')
                url=ssp.find('a',attrs={'class':'btn btn-primary btn-visit-tut js-tutorial '})['href']
                #print(url)
                sub_id=random.randint(1,users)
                taught_id=random.randint(1,users)
                x=random.randint(0,len(type)-1)
                y=random.randint(0,len(content)-1)
                z=random.randint(0,len(level)-1)
                s=str(ccount)+"~"+str(tcount)+"~"+title+"~"+url+"~"+str(sub_id)+"~"+str(taught_id)+"~"+str(upvts)+"~"+type[x]+"~"+content[y]+"~"+level[z]+"~"+"\n"
                tfile.write(s)
cfile.close()
tfile.close()
                

