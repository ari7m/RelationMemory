public class RandomPlayer extends Player{
    private int[] trueNum;
    private int trueCnt;
    private int cnt;
    public RandomPlayer(Board board,Director director,int mark){
		super(board, director, mark);
		this.trueCnt = this.board.getlen();
		trueNum = new int[this.trueCnt];

		for (int i = 0; i < this.trueCnt ; i++){
		    trueNum[i] = i;
		}
    }
    
    
     public void turn(){
	 this.cnt = 0;
	 for (int i = 0; i < this.trueCnt; i++ ){
	     System.out.println(i);
	      if(this.director.setCheck(trueNum[i],mark)) {
		  System.out.println(cnt +" "+ i);
		  trueNum[cnt] = i;
		  this.cnt++;
	      }
	 }
	        this.trueCnt = this.cnt;
	      System.out.println(this.cnt + this.trueCnt);
	      int x = new java.util.Random().nextInt(this.trueCnt);
	      System.out.println("Ram" + x);
	      this.board.set(trueNum[x],mark);
     }
	 
}

